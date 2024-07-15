<?php

namespace Database\Seeders;

use App\Models\Blogs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'Bí Quyết Chọn Giày Dép Phù Hợp Với Từng Hoàn Cảnh',

                'description' => 'Dự tiệc: Một đôi giày cao gót sẽ giúp bạn nổi bật và thanh lịch. Hãy chọn những đôi có thiết kế tinh tế và màu sắc trung tính như đen, nude hoặc bạc.
                Đi làm: Giày bệt hoặc giày cao gót vừa phải sẽ là lựa chọn tốt. Đảm bảo giày có độ thoải mái và không gây đau chân.
                Dạo phố: Giày thể thao hoặc giày lười sẽ mang lại sự thoải mái và phong cách trẻ trung. Bạn có thể chọn những màu sắc tươi sáng hoặc họa tiết nổi bật để tạo điểm nhấn.
                Du lịch: Sandal hoặc giày lười sẽ giúp bạn di chuyển dễ dàng và thoải mái. Chọn những đôi giày có đế êm ái và chất liệu thoáng mát.',
                'image' => 'user_template/images/poster.jpg'
            ],
            [
                'title' => 'Bí Quyết Chọn Giày Dép Phù Hợp Với Từng Hoàn Cảnh',

                'description' => 'Giày dép là phụ kiện không thể thiếu trong tủ đồ của mỗi người, nhưng việc chọn giày dép phù hợp với từng hoàn cảnh lại là điều không dễ dàng. Khi đi dự tiệc, một đôi giày cao gót sẽ giúp bạn nổi bật và thanh lịch, hãy chọn những đôi có thiết kế tinh tế và màu sắc trung tính như đen, nude hoặc bạc. Đối với môi trường làm việc, giày bệt hoặc giày cao gót vừa phải sẽ là lựa chọn tốt nhất, đảm bảo giày có độ thoải mái và không gây đau chân. Khi dạo phố, giày thể thao hoặc giày lười sẽ mang lại sự thoải mái và phong cách trẻ trung; bạn có thể chọn những màu sắc tươi sáng hoặc họa tiết nổi bật để tạo điểm nhấn. Cuối cùng, khi đi du lịch, sandal hoặc giày lười sẽ giúp bạn di chuyển dễ dàng và thoải mái; chọn những đôi giày có đế êm ái và chất liệu thoáng mát để đảm bảo sự thoải mái suốt cả chuyến đi.',
                'image' => 'user_template/images/poster.jpg'

            ],
            [
                'title' => 'Xu Hướng Giày Dép 2024: Những Mẫu Giày Không Thể Bỏ Lỡ',

                'description' => 'Năm 2024 đã đến với những xu hướng giày dép mới mẻ và đầy sáng tạo, khiến chúng ta không thể bỏ lỡ những mẫu giày sau. Đầu tiên, giày thể thao chunky vẫn tiếp tục thịnh hành, mang lại sự thoải mái và phong cách cá tính, hiện đại. Tiếp theo, giày mũi vuông, kiểu giày cổ điển nhưng được làm mới với nhiều thiết kế đa dạng, giúp tạo cảm giác chân thon dài và thanh lịch. Ngoài ra, những đôi sandal dây đan chéo hoặc dây mảnh đang trở lại mạnh mẽ, không chỉ phù hợp với trang phục hè mà còn tạo nên vẻ ngoài nữ tính và quyến rũ. Cuối cùng, giày lười da là lựa chọn hoàn hảo cho những ai yêu thích phong cách thanh lịch và thoải mái, dễ dàng kết hợp với nhiều loại trang phục khác nhau. Những xu hướng này chắc chắn sẽ mang đến cho bạn một năm đầy phong cách và ấn tượng.',
                'image' => 'user_template/images/poster.jpg'

            ],
            [
                'title' => 'Cách Bảo Quản Giày Dép Để Luôn Như Mới',

                'description' => 'Bảo quản giày dép đúng cách không chỉ giúp chúng luôn như mới mà còn kéo dài tuổi thọ của sản phẩm. Đầu tiên, hãy làm sạch giày dép sau mỗi lần sử dụng, đặc biệt khi chúng bị bẩn, bằng cách sử dụng bàn chải mềm và dung dịch làm sạch phù hợp với chất liệu giày. Tiếp theo, sử dụng các sản phẩm bảo vệ như xịt chống thấm và kem dưỡng da cho giày da để giày dép không bị ẩm mốc hay thấm nước. Để giày dép ở nơi khô ráo, thoáng mát, tránh ánh nắng trực tiếp và nhiệt độ cao; sử dụng giấy báo hoặc chất liệu hút ẩm để giữ giày không bị ẩm. Đối với giày cao gót hay giày da, hãy sử dụng khuôn giày để giữ hình dáng ban đầu, giúp giày không bị biến dạng và luôn trông như mới. Những mẹo nhỏ này sẽ giúp bạn bảo quản giày dép hiệu quả và luôn giữ được vẻ đẹp ban đầu.',
                'image' => 'user_template/images/poster.jpg'

            ],

        ];

        foreach ($blogs as $blog) {
            Blogs::create($blog);
        }
    }
}
