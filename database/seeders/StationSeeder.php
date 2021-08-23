<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stations= array(
            array('id' => '1','name' => 'BARINGO HUDUMA CENTRE','code' => 'BRC-001','region' => 'North Rift Region','location' => 'County Commissioner Office, Kabarnet Town'),
            array('id' => '2','name' => 'BOMET HUDUMA CENTRE','code' => 'BMT-001','region' => 'Central & South Rift Region','location' => 'County Commisioners Office, Bomet town'),
            array('id' => '3','name' => 'BUNGOMA HUDUMA CENTRE','code' => 'BGC-001','region' => 'Western Region','location' => 'Post Office, Moi Avenue Road, Bungoma Town'),
            array('id' => '4','name' => 'BUSIA HUDUMA CENTRE','code' => 'BSC-001','region' => 'Western Region','location' => 'Post Office, Opposite Government Offices'),
            array('id' => '5','name' => 'CITY SQUARE HUDUMA CENTRE','code' => 'NAC-002','region' => 'Nairobi and Central Region','location' => 'Huduma City Square: Haile Selassie, Next to Technical University of Kenya'),
            array('id' => '6','name' => 'EASTLEIGH HUDUMA CENTRE','code' => 'NAC-004','region' => 'Nairobi and Central Region','location' => 'Huduma Eastleigh: Eastleigh Eleventh Street'),
            array('id' => '7','name' => 'ELGEYO MARAKWET HUDUMA CENTRE','code' => 'EGM-001','region' => 'North Rift Region','location' => 'Iten Town'),
            array('id' => '8','name' => 'EMBU HUDUMA CENTRE','code' => 'EMC-001','region' => 'Eastern Region','location' => 'Post Office, Next to County Commissioner\'s Office, Meru-Nairobi Highway, Embu Town'),
            array('id' => '9','name' => 'GARISSA HUDUMA CENTRE','code' => 'GRC-001','region' => 'Northern Region','location' => 'County Commissioner Office,Garissa Town'),
            array('id' => '10','name' => 'HOMABAY HUDUMA CENTRE','code' => 'HBC-001','region' => 'Western Region','location' => 'County Commissioner Office, Next to County Assembly'),
            array('id' => '11','name' => 'ISIOLO HUDUMA CENTRE','code' => 'ISC-001','region' => 'Eastern Region','location' => 'Post Office, Hospital Road, Off Isiolo-Marsabit Highway'),
            array('id' => '12','name' => 'KAJIADO HUDUMA CENTRE','code' => 'KJC-001','region' => 'Central & South Rift Region','location' => 'Post Office, Nairobi-Namanga Highway'),
            array('id' => '13','name' => 'KAJIADO WEST HUDUMA CENTRE','code' => 'KJC-002','region' => 'Central & South Rift Region','location' => 'Kajiado West, Kisamis town along Ngong-Magadi Road'),
            array('id' => '14','name' => 'KAKAMEGA HUDUMA CENTRE','code' => 'KKC-001','region' => 'Western Region','location' => 'Post Office, Kakamega-Kisumu Highway'),
            array('id' => '15','name' => 'KERICHO HUDUMA CENTRE','code' => 'KRC-001','region' => 'Central & South Rift','location' => 'Ardhi House, Temple Street, Kericho Town'),
            array('id' => '16','name' => 'KIAMBU HUDUMA CENTRE','code' => 'KBU-001','region' => 'Nairobi and Central Region','location' => 'Assistant County Commissioner Office (DO),Opposite Thika Stadium, Thika Town'),
            array('id' => '17','name' => 'KIBRA HUDUMA CENTRE','code' => 'NAC-005','region' => 'Nairobi and Central Region','location' => 'Huduma Kibra: County Commissioner\'\'s Office, Kibera Drive'),
            array('id' => '18','name' => 'KILIFI HUDUMA CENTRE','code' => 'KFC-001','region' => 'Coast Region','location' => 'County Commisioner Office, Kilifi Town'),
            array('id' => '19','name' => 'KIRINYAGA HUDUMA CENTRE','code' => 'KYC-001','region' => 'Central Region','location' => 'County Commissioner, Kerugoya Town'),
            array('id' => '20','name' => 'KISII HUDUMA CENTRE','code' => 'KIC-001','region' => 'Western Region','location' => 'Post Office, Kisii-Migori Road, Kisii Town'),
            array('id' => '21','name' => 'KISUMU HUDUMA CENTRE','code' => 'KSC-001','region' => 'Western Region','location' => 'Former PC Office, Prosperity House, Next to Central Bank'),
            array('id' => '22','name' => 'KITALE HUDUMA CENTRE','code' => 'KTC-001','region' => 'North Rift Region','location' => 'Kitale Post Office, Mak-Asembo Road'),
            array('id' => '23','name' => 'KITUI HUDUMA CENTRE','code' => 'KUC-001','region' => 'Eastern Region','location' => 'Post Office, Opposite Catholic Church, Kitui Town'),
            array('id' => '24','name' => 'KWALE HUDUMA CENTRE','code' => 'KWC-001','region' => 'Coast Region','location' => 'Kwale-Kinango Road, Opposite National Police Service'),
            array('id' => '25','name' => 'LAIKIPIA HUDUMA CENTRE','code' => 'LKC-001','region' => 'Central & South Rift','location' => 'County Commissioner Office, Nanyuki Town'),
            array('id' => '26','name' => 'LAMU HUDUMA CENTRE','code' => 'LMC-001','region' => 'Coast Region','location' => 'Old Jetty, Next to County Commissioner Office, Kenyatta Road'),
            array('id' => '27','name' => 'MACHAKOS HUDUMA CENTRE','code' => 'MCC-001','region' => 'Eastern Region','location' => 'Post Office, Opposite Cathedral Church,Machakos'),
            array('id' => '28','name' => 'MAKADARA HUDUMA CENTRE','code' => 'NAC-003','region' => 'Nairobi and Central Region','location' => 'City County Offices- Eastlands Revenue Building, Off Jogoo Road, Next to DC Makadara'),
            array('id' => '29','name' => 'MAKUENI HUDUMA CENTRE','code' => 'MKC-001','region' => 'Eastern Region','location' => 'Post Office, Next to County Commissioner Office,Wote'),
            array('id' => '30','name' => 'MANDERA HUDUMA CENTRE','code' => 'MDR-001','region' => 'Northern Region','location' => 'Mandera Central'),
            array('id' => '31','name' => 'MARSABIT HUDUMA CENTRE','code' => 'MRC-001','region' => 'Eastern Region','location' => 'Post Office, Post Office Road, Marsabit Town'),
            array('id' => '32','name' => 'MERU HUDUMA CENTRE','code' => 'MEC-001','region' => 'Eastern Region','location' => 'Post Office, Opposite County Commissioner Office, Meru-Makutano Highway, Meru Town'),
            array('id' => '33','name' => 'MIGORI HUDUMA CENTRE','code' => 'MIC-001','region' => 'Western Region','location' => 'County Commissioners Office, Migori Town'),
            array('id' => '34','name' => 'MOMBASA HUDUMA CENTRE','code' => 'MBC-001','region' => 'Coast Region','location' => 'General Post Office, Opposite Safaricom Customercare, Digo Road, Mombasa'),
            array('id' => '35','name' => 'MURANGA HUDUMA CENTRE','code' => 'MUC-001','region' => 'Central Region','location' => 'County Commissioners Office, Muranga Town'),
            array('id' => '36','name' => 'NAKURU HUDUMA CENTRE','code' => 'NKC-001','region' => 'Central & South Rift','location' => 'General Post Office, Next to Merica Hotel, Kenyatta Avenue'),
            array('id' => '37','name' => 'NANDI HUDUMA CENTRE','code' => 'NNC-001','region' => 'North Rift Region','location' => 'Post Office, Kapsabet Town'),
            array('id' => '38','name' => 'NAROK HUDUMA CENTRE','code' => 'NRC-001','region' => 'Central & Rift Region','location' => 'Post Office, Olerorat House,Narok Town, Narok-Nairobi Highway'),
            array('id' => '39','name' => 'NYAMIRA HUDUMA CENTRE','code' => 'NMC-001','region' => 'Western Region','location' => 'Post Office, Konate-Nyamira Road'),
            array('id' => '40','name' => 'NYANDARUA HUDUMA CENTRE','code' => 'NDC-001','region' => 'Nairobi and Central Region','location' => 'County Commissioner\'s Office, Olkalau Township'),
            array('id' => '41','name' => 'NYERI HUDUMA CENTRE','code' => 'NYC-001','region' => 'Nairobi and Central Region','location' => 'Former Provincial Commissioner\'s Office, Nyeri Town'),
            array('id' => '42','name' => 'GPO HUDUMA CENTRE','code' => 'NAC-001','region' => 'Nairobi and Central Region','location' => 'Huduma GPO: Teleposta Building, Kenyatta Avenue.'),
            array('id' => '43','name' => 'SAMBURU HUDUMA CENTRE','code' => 'SAC-001','region' => 'North Rift Region','location' => 'General Post Office, Maralal'),
            array('id' => '44','name' => 'SIAYA HUDUMA CENTRE','code' => 'SIC-001','region' => 'Western Region','location' => 'Post Office, Kisumu-Busia Highway. Opposite KCB'),
            array('id' => '45','name' => 'TAITA TAVETA HUDUMA CENTRE','code' => 'TTC-001','region' => 'Coast Region','location' => 'CDF Office, Wundanyi'),
            array('id' => '46','name' => 'TANA RIVER HUDUMA CENTRE','code' => 'TNR-001','region' => 'Coast Region','location' => 'County Commisioners Office, Hola Town'),
            array('id' => '47','name' => 'THARAKA NITHI HUDUMA CENTRE','code' => 'TNC-001','region' => 'Eastern Region','location' => 'County Commissioner Office, Chuka Town'),
            array('id' => '48','name' => 'TURKANA HUDUMA CENTRE','code' => 'TRC-001','region' => 'North Rift Region','location' => 'County Commissioner\'s Office, Lodwar'),
            array('id' => '49','name' => 'UASIN GISHU HUDUMA CENTRE','code' => 'UGC-001','region' => 'North Rift Region','location' => 'Post Office, Eldoret-Kitale Road, Eldoret Town'),
            array('id' => '50','name' => 'VIHIGA HUDUMA CENTRE','code' => 'VHG-001','region' => 'Western Region','location' => 'County Commisioners Office, Vihiga town'),
            array('id' => '51','name' => 'WAJIR HUDUMA CENTRE','code' => 'WJC-001','region' => 'Northern Region','location' => 'County Commissioner\'s Office, Next to County Assembly, Wajir'),
            array('id' => '52','name' => 'WEST POKOT HUDUMA CENTRE','code' => 'WPK-001','region' => 'North Rift Region','location' => 'Makutano Town near Kapenguria'),
            array('id' => '53','name' => 'HUDUMA KENYA SECRETARIAT','code' => 'HKS-001','region' => 'Nairobi HQ','location' => 'Lonrho House')
        );


        foreach ($stations as $station){
            Station::updateOrCreate(['id'=>$station['id']],$station);

        }
    }
}
