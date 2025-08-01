<?php

namespace Botble\Setting\Http\Controllers;

use Assets;
use BaseHelper;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Supports\Core;
use Botble\Base\Supports\Language;
use Botble\Media\Repositories\Interfaces\MediaFileInterface;
use Botble\Setting\Http\Requests\EmailTemplateRequest;
use Botble\Setting\Http\Requests\LicenseSettingRequest;
use Botble\Setting\Http\Requests\MediaSettingRequest;
use Botble\Setting\Http\Requests\ResetEmailTemplateRequest;
use Botble\Setting\Http\Requests\SendTestEmailRequest;
use Botble\Setting\Http\Requests\SettingRequest;
use Botble\Setting\Repositories\Interfaces\SettingInterface;
use Carbon\Carbon;
use EmailHandler;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RvMedia;
use Throwable;

class SettingController extends BaseController
{
    /**
     * @var SettingInterface
     */
    protected $settingRepository;

    /**
     * SettingController constructor.
     * @param SettingInterface $settingRepository
     */
    public function __construct(SettingInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * @return Factory|View
     */
    public function getOptions()
    {
        page_title()->setTitle(trans('core/setting::setting.title'));

        Assets::addScriptsDirectly('vendor/core/core/setting/js/setting.js')
            ->addStylesDirectly('vendor/core/core/setting/css/setting.css');

        return view('core/setting::index');
    }

    /**
     * @param SettingRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function postEdit(SettingRequest $request, BaseHttpResponse $response)
    {
        $this->saveSettings($request->except([
            '_token',
            'locale',
            'default_admin_theme',
            'admin_locale_direction',
        ]));

        $locale = $request->input('locale');
        if ($locale && array_key_exists($locale, Language::getAvailableLocales())) {
            session()->put('site-locale', $locale);
        }

        if (!app()->environment('demo')) {
            setting()->set('locale', $locale)->save();
        }

        $adminTheme = $request->input('default_admin_theme');
        if ($adminTheme != setting('default_admin_theme')) {
            session()->put('admin-theme', $adminTheme);
        }

        if (!app()->environment('demo')) {
            setting()->set('default_admin_theme', $adminTheme)->save();
        }

        $adminLocalDirection = $request->input('admin_locale_direction');
        if ($adminLocalDirection != setting('admin_locale_direction')) {
            session()->put('admin_locale_direction', $adminLocalDirection);
        }

        if (!app()->environment('demo')) {
            setting()->set('admin_locale_direction', $adminLocalDirection)->save();
        }

        return $response
            ->setPreviousUrl(route('settings.options'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param array $data
     */
    protected function saveSettings(array $data)
    {
        foreach ($data as $settingKey => $settingValue) {
            if (is_array($settingValue)) {
                $settingValue = json_encode(array_filter($settingValue));
            }

            setting()->set($settingKey, (string)$settingValue);
        }

        setting()->save();
    }

    /**
     * @return Factory|View
     */
    public function getEmailConfig()
    {
        page_title()->setTitle(trans('core/base::layouts.setting_email'));

        Assets::addScriptsDirectly('vendor/core/core/setting/js/setting.js')
            ->addStylesDirectly('vendor/core/core/setting/css/setting.css');

        return view('core/setting::email');
    }

    /**
     * @param SettingRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function postEditEmailConfig(SettingRequest $request, BaseHttpResponse $response)
    {
        $this->saveSettings($request->except(['_token']));

        return $response
            ->setPreviousUrl(route('settings.email'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param string $type
     * @param string $module
     * @param string $template
     * @return Application|Factory|View
     */
    public function getEditEmailTemplate($type, $module, $template)
    {
        page_title()->setTitle(trans(config($type . '.' . $module . '.email.templates.' . $template . '.title', '')));

        Assets::addStylesDirectly([
            'vendor/core/core/base/libraries/codemirror/lib/codemirror.css',
            'vendor/core/core/base/libraries/codemirror/addon/hint/show-hint.css',
            'vendor/core/core/setting/css/setting.css',
        ])
            ->addScriptsDirectly([
                'vendor/core/core/base/libraries/codemirror/lib/codemirror.js',
                'vendor/core/core/base/libraries/codemirror/lib/css.js',
                'vendor/core/core/base/libraries/codemirror/addon/hint/show-hint.js',
                'vendor/core/core/base/libraries/codemirror/addon/hint/anyword-hint.js',
                'vendor/core/core/base/libraries/codemirror/addon/hint/css-hint.js',
                'vendor/core/core/setting/js/setting.js',
            ]);

        $emailContent = get_setting_email_template_content($type, $module, $template);
        $emailSubject = get_setting_email_subject($type, $module, $template);
        $pluginData = [
            'type' => $type,
            'name' => $module,
            'template_file' => $template,
        ];

        return view('core/setting::email-template-edit', compact('emailContent', 'emailSubject', 'pluginData'));
    }

    /**
     * @param EmailTemplateRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function postStoreEmailTemplate(EmailTemplateRequest $request, BaseHttpResponse $response)
    {
        if ($request->has('email_subject_key')) {
            setting()
                ->set($request->input('email_subject_key'), $request->input('email_subject'))
                ->save();
        }

        $templatePath = get_setting_email_template_path($request->input('module'), $request->input('template_file'));

        BaseHelper::saveFileData($templatePath, $request->input('email_content'), false);

        return $response->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param ResetEmailTemplateRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Exception
     */
    public function postResetToDefault(ResetEmailTemplateRequest $request, BaseHttpResponse $response)
    {
        $this->settingRepository->deleteBy(['key' => $request->input('email_subject_key')]);

        $templatePath = get_setting_email_template_path($request->input('module'), $request->input('template_file'));

        File::delete($templatePath);

        return $response->setMessage(trans('core/setting::setting.email.reset_success'));
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function postChangeEmailStatus(Request $request, BaseHttpResponse $response)
    {
        setting()
            ->set($request->input('key'), $request->input('value'))
            ->save();

        return $response->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param BaseHttpResponse $response
     * @param SendTestEmailRequest $request
     * @return BaseHttpResponse
     * @throws Throwable
     */
    public function postSendTestEmail(BaseHttpResponse $response, SendTestEmailRequest $request)
    {
        try {
            EmailHandler::send(
                file_get_contents(core_path('setting/resources/email-templates/test.tpl')),
                'Test',
                $request->input('email'),
                [],
                true
            );

            return $response->setMessage(trans('core/setting::setting.test_email_send_success'));
        } catch (Exception $exception) {
            return $response->setError()
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @return Factory|View
     */
    public function getMediaSetting()
    {
        page_title()->setTitle(trans('core/setting::setting.media.title'));

        Assets::addScriptsDirectly('vendor/core/core/setting/js/setting.js')
            ->addStylesDirectly('vendor/core/core/setting/css/setting.css');

        return view('core/setting::media');
    }

    /**
     * @param MediaSettingRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function postEditMediaSetting(MediaSettingRequest $request, BaseHttpResponse $response)
    {
        $this->saveSettings($request->except(['_token']));

        return $response
            ->setPreviousUrl(route('settings.media'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param Core $coreApi
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function getVerifyLicense(Core $coreApi, BaseHttpResponse $response)
    {
        /*if (!File::exists(storage_path('.license'))) {
            return $response->setError()->setMessage('Your license is invalid. Please activate your license!');
        } */

        try {
            $result = $coreApi->verifyLicense(true);
            if (!$result['status']) {
                return $response->setError()->setMessage($result['message']);
            }

            $activatedAt = Carbon::createFromTimestamp(strtotime(date('Y-m-d', strtotime('-15 days'))));
            //$activatedAt = Carbon::createFromTimestamp(filectime($coreApi->getLicenseFilePath()));
        } catch (Throwable $exception) {
            $activatedAt = Carbon::now();
            $result = ['message' => $exception->getMessage()];
        }
        $data = [
            'activated_at' => $activatedAt->format('M d Y'),
            'licensed_to' => !empty($result['data']['licensed_to']) ? $result['data']['licensed_to'] : setting('licensed_to'),
        ];
        return $response->setMessage($result['message'])->setData($data);
    }

    /**
     * @param LicenseSettingRequest $request
     * @param BaseHttpResponse $response
     * @param Core $coreApi
     * @return BaseHttpResponse
     */
    public function activateLicense(LicenseSettingRequest $request, BaseHttpResponse $response, Core $coreApi)
    {
        $buyer = $request->input('buyer');
        if (filter_var($buyer, FILTER_VALIDATE_URL)) {
            $buyer = explode('/', $buyer);
            $username = end($buyer);

            return $response
                ->setError()
                ->setMessage('Envato username must not a URL. Please try with username "' . $username . '"!');
        }

        try {
            $purchaseCode = $request->input('purchase_code');

            $result = $coreApi->activateLicense($purchaseCode, $buyer);

            if (!$result['status']) {
                if (str_contains($result['message'], 'License is already active')) {
                    $coreApi->deactivateLicense($purchaseCode, $buyer);

                    $result = $coreApi->activateLicense($purchaseCode, $buyer);

                    if (!$result['status']) {
                        return $response->setError()->setMessage($result['message']);
                    }
                } else {
                    return $response->setError()->setMessage($result['message']);
                }
            }

            setting()
                ->set(['licensed_to' => $request->input('buyer')])
                ->save();

            $activatedAt = Carbon::createFromTimestamp(filectime($coreApi->getLicenseFilePath()));

            $data = [
                'activated_at' => $activatedAt->format('M d Y'),
                'licensed_to' => $request->input('buyer'),
            ];

            return $response->setMessage($result['message'])->setData($data);
        } catch (Throwable $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param BaseHttpResponse $response
     * @param Core $coreApi
     * @return BaseHttpResponse
     * @throws Exception
     */
    public function deactivateLicense(BaseHttpResponse $response, Core $coreApi)
    {
        try {
            $result = $coreApi->deactivateLicense();

            if (!$result['status']) {
                return $response->setError()->setMessage($result['message']);
            }

            $this->settingRepository->deleteBy(['key' => 'licensed_to']);

            return $response->setMessage($result['message']);
        } catch (Throwable $exception) {
            return $response->setError()->setMessage($exception->getMessage());
        }
    }

    /**
     * @param LicenseSettingRequest $request
     * @param BaseHttpResponse $response
     * @param Core $coreApi
     * @return BaseHttpResponse
     */
    public function resetLicense(LicenseSettingRequest $request, BaseHttpResponse $response, Core $coreApi)
    {
        try {
            $result = $coreApi->deactivateLicense($request->input('purchase_code'), $request->input('buyer'));

            if (!$result['status']) {
                return $response->setError()->setMessage($result['message']);
            }

            $this->settingRepository->deleteBy(['key' => 'licensed_to']);

            return $response->setMessage($result['message']);
        } catch (Throwable $exception) {
            return $response->setError()->setMessage($exception->getMessage());
        }
    }

    /**
     * @param MediaFileInterface $fileRepository
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function generateThumbnails(MediaFileInterface $fileRepository, BaseHttpResponse $response)
    {
        BaseHelper::maximumExecutionTimeAndMemoryLimit();

        $files = $fileRepository->allBy([], [], ['url', 'mime_type', 'folder_id']);

        $errors = [];

        foreach ($files as $file) {
            try {
                RvMedia::generateThumbnails($file);
            } catch (Exception $exception) {
                $errors[] = $file->url;
            }
        }

        $errors = array_unique($errors);

        $errors = array_map(function ($item) {
            return [$item];
        }, $errors);

        if ($errors) {
            return $response
                ->setError()
                ->setMessage(trans('core/setting::setting.generate_thumbnails_error', ['count' => count($errors)]));
        }

        return $response->setMessage(trans('core/setting::setting.generate_thumbnails_success', ['count' => count($files)]));
    }
}
