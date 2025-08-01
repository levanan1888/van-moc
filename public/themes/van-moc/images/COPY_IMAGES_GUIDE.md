# Hướng dẫn Copy Hình Ảnh

Để hoàn thiện giao diện Vạn Mộc, bạn cần copy các hình ảnh từ thư mục `test/` vào các thư mục tương ứng trong `platform/themes/van-moc/public/images/`:

## 1. Logo và Icons chính
```
test/c88b292dea22637c3a33.jpg → platform/themes/van-moc/public/images/logo.png
test/VMM_ICON/VMM_ICON/arrow.svg → platform/themes/van-moc/public/images/arrow.svg
test/VMM_ICON/VMM_ICON/search.png → platform/themes/van-moc/public/images/search.png
test/VMM_ICON/VMM_ICON/cart.svg → platform/themes/van-moc/public/images/cart.svg
test/VMM_ICON/VMM_ICON/button_arrow.svg → platform/themes/van-moc/public/images/button_arrow.svg
test/VMM_ICON/VMM_ICON/button_docngay.svg → platform/themes/van-moc/public/images/button_docngay.svg
test/VMM_ICON/VMM_ICON/icon_cart.svg → platform/themes/van-moc/public/images/icon_cart.svg
```

## 2. Hình ảnh sản phẩm
```
test/VMM_image/VMM_image/hinh product/property11.png → platform/themes/van-moc/public/images/products/property11.png
test/VMM_image/VMM_image/hinh product/property12.png → platform/themes/van-moc/public/images/products/property12.png
test/VMM_image/VMM_image/hinh product/property13.png → platform/themes/van-moc/public/images/products/property13.png
test/VMM_image/VMM_image/hinh product/property14.png → platform/themes/van-moc/public/images/products/property14.png
test/VMM_image/VMM_image/hinh product/property15.png → platform/themes/van-moc/public/images/products/property15.png
test/VMM_image/VMM_image/hinh product/property16.png → platform/themes/van-moc/public/images/products/property16.png
test/VMM_image/VMM_image/hinh product/property17.png → platform/themes/van-moc/public/images/products/property17.png
test/VMM_image/VMM_image/hinh product/property18.png → platform/themes/van-moc/public/images/products/property18.png
```

## 3. Hình ảnh danh mục
```
test/category-homepage/srisri.png → platform/themes/van-moc/public/images/categories/srisri.png
test/category-homepage/moc-huong.png → platform/themes/van-moc/public/images/categories/moc-huong.png
test/category-homepage/brands.png → platform/themes/van-moc/public/images/categories/brands.png
test/category-homepage/forganic.png → platform/themes/van-moc/public/images/categories/forganic.png
```

## 4. Hình ảnh sections
```
test/VMM_image/VMM_image/section_vanmocmall/untitled1recovered1.png → platform/themes/van-moc/public/images/sections/vanmocmall.png
test/VMM_image/VMM_image/image215.png → platform/themes/van-moc/public/images/sections/agent.png
```

## 5. Icons phát triển bền vững
```
test/icon-phat-trien-ben-vung/icon-thuan-tu-nhien.jpg → platform/themes/van-moc/public/images/icons/icon-thuan-tu-nhien.jpg
test/icon-phat-trien-ben-vung/icon-ben-vung.jpg → platform/themes/van-moc/public/images/icons/icon-ben-vung.jpg
test/icon-phat-trien-ben-vung/icon-lan-toa.jpg → platform/themes/van-moc/public/images/icons/icon-lan-toa.jpg
```

## 6. Hình ảnh blog
```
test/VMM_image/VMM_image/hinh_blog(2)/libary1.png → platform/themes/van-moc/public/images/blog/libary1.png
test/VMM_image/VMM_image/hinh_blog(2)/libary2.png → platform/themes/van-moc/public/images/blog/libary2.png
test/VMM_image/VMM_image/hinh_blog(2)/libary3.png → platform/themes/van-moc/public/images/blog/libary3.png
test/VMM_image/VMM_image/hinh_blog(2)/libary4.png → platform/themes/van-moc/public/images/blog/libary4.png
```

## 7. Icons social media
```
test/VMM_ICON/VMM_ICON/socialicon1.svg → platform/themes/van-moc/public/images/social/facebook.svg
test/VMM_ICON/VMM_ICON/socialicon2.svg → platform/themes/van-moc/public/images/social/linkedin.svg
test/VMM_ICON/VMM_ICON/socialicon3.svg → platform/themes/van-moc/public/images/social/twitter.svg
test/VMM_ICON/VMM_ICON/socialicon4.svg → platform/themes/van-moc/public/images/social/pinterest.svg
```

## 8. Icons footer
```
test/VMM_ICON/VMM_ICON/local_icon.svg → platform/themes/van-moc/public/images/local_icon.svg
test/VMM_ICON/VMM_ICON/email_icon.svg → platform/themes/van-moc/public/images/email_icon.svg
test/VMM_ICON/VMM_ICON/call_icon.svg → platform/themes/van-moc/public/images/call_icon.svg
test/VMM_ICON/VMM_ICON/decorate_icon.png → platform/themes/van-moc/public/images/decorate_icon.png
test/VMM_ICON/VMM_ICON/decorate_icon2.png → platform/themes/van-moc/public/images/decorate_icon2.png
```

## Sau khi copy xong:
1. Chạy lệnh: `php artisan cms:theme:assets:publish`
2. Refresh trang web để xem kết quả

## Lưu ý:
- Nếu hình ảnh không hiển thị, kiểm tra đường dẫn trong các file blade
- Đảm bảo tên file và thư mục chính xác
- Có thể sử dụng default images từ ripple theme nếu cần 