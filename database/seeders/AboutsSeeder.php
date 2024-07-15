<?php

namespace Database\Seeders;

use App\Models\Abouts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $abouts = [
            [
                'title' => 'Tầm nhìn, Sứ mệnh của Coza Footwear',

                'description' => 'Coza Footwear hướng tới việc trở thành thương hiệu giày dép hàng đầu không chỉ tại Việt Nam mà còn trên thị trường quốc tế. Chúng tôi mong muốn mang đến cho khách hàng những sản phẩm giày dép không chỉ đẹp mắt mà còn chất lượng, thoải mái và hợp thời trang. Mục tiêu của chúng tôi là thiết lập một tiêu chuẩn mới về phong cách và sự tiện nghi trong ngành công nghiệp giày dép.Sứ mệnh của Coza Footwear là tạo ra những đôi giày không chỉ là một phụ kiện thời trang mà còn là biểu tượng của sự thoải mái và phong cách sống. Chúng tôi cam kết cung cấp những sản phẩm giày dép chất lượng cao, được chế tác từ những vật liệu tốt nhất và được thiết kế để đáp ứng nhu cầu đa dạng của khách hàng. Chúng tôi luôn nỗ lực để mang lại trải nghiệm mua sắm tuyệt vời và dịch vụ chăm sóc khách hàng chuyên nghiệp.'
            ],
            [
                'title' => 'Nhiệm vụ của Coza Footwear',

                'description' => 'là mang đến cho khách hàng những sản phẩm giày dép chất lượng nhất, từ việc chọn lựa vật liệu đến quy trình sản xuất, luôn đảm bảo sự hoàn hảo trong từng chi tiết. Chúng tôi không ngừng đổi mới và sáng tạo, liên tục cập nhật xu hướng thời trang để mang lại những thiết kế mới lạ và phù hợp với sở thích đa dạng của khách hàng. Đồng thời, Coza Footwear tạo ra một môi trường mua sắm thân thiện và thoải mái, với đội ngũ nhân viên nhiệt tình và chuyên nghiệp, luôn sẵn sàng hỗ trợ khách hàng. Chúng tôi cam kết thực hiện các biện pháp bảo vệ môi trường trong quá trình sản xuất và kinh doanh, hướng tới sự phát triển bền vững. Ngoài ra, Coza Footwear không ngừng mở rộng hệ thống cửa hàng và kênh bán hàng trực tuyến để tiếp cận nhiều khách hàng hơn, cả trong và ngoài nước. Với những nỗ lực này, chúng tôi tin rằng Coza Footwear sẽ mang lại giá trị đích thực cho khách hàng và góp phần vào sự phát triển của ngành công nghiệp giày dép.'
            ],
        ];

        foreach ($abouts as $about) {
            Abouts::create($about);
        }
    }
}
