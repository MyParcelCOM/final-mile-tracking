<?php

declare(strict_types=1);

namespace MyParcelCom\FinalMileCarrier;

use MyParcelCom\FinalMileCarrier\Exception\CarrierNotSupportedException;

class FinalMileCarrier
{
    private string $name;
    private string $url;

    private const CORREO_ARGENTINO = 'Correo Argentino';
    private const AUSTRALIA_POST = 'Australia Post';
    private const OSTERREICHISCHE_POST = 'Österreichische Post';
    private const BPOST = 'bpost';
    private const CORREIOS_DE_BRASIL = 'Correios de Brasil';
    private const BULGARIAN_POSTS = 'Bulgarian Posts';
    private const CANADA_POST = 'Canada Post';
    private const CORREOS_CHILE = 'Correos Chile';
    private const HRVATSKA_POSTA = 'Hrvatska pošta';
    private const CYPRUS_POST = 'Cyprus Post';
    private const CESKA_POSTA = 'Česká pošta';
    private const EGYPT_POST = 'Egypt Post';
    private const OMNIVA = 'Omniva';
    private const POSTI = 'Posti';
    private const LE_GROUPE_LA_POSTE = 'Le Groupe La Poste';
    private const DEUTSCHE_POST = 'Deutsche Post';
    private const GHANA_POST = 'Ghana Post';
    private const ELTA = 'ELTA';
    private const HONGKONG_POST = 'Hongkong Post';
    private const MAGYAR_POSTA = 'Magyar Posta';
    private const ICELAND_POST = 'Iceland Post';
    private const INDIA_POST = 'India Post';
    private const POS_INDONESIA = 'Pos Indonesia';
    private const AN_POST = 'An Post';
    private const POSTE_ITALIANE = 'Poste Italiane';
    private const JAPAN_POST = 'Japan Post';
    private const KOREA_POST = 'Korea Post';
    private const LATVIJAS_PASTS = 'Latvijas Pasts';
    private const LIETUVOS_PASTAS = 'Lietuvos paštas';
    private const POSTLUXEMBOURG = 'POSTLuxembourg';
    private const POS_MALAYSIA = 'Pos Malaysia';
    private const MALTA_POST = 'Malta Post';
    private const MEXICO = 'Correos De Mexico';
    private const POSTNL = 'PostNL';
    private const NEW_ZEALAND_POST = 'New Zealand Post';
    private const NIGERIAN_POSTAL_SERVICE = 'Nigerian Postal Service';
    private const POSTEN_NORGE = 'Posten Norge';
    private const PHLPOST = 'PHLPost';
    private const POCZTA_POLSKA = 'Poczta Polska';
    private const CTT = 'CTT';
    private const POSTA_ROMANA = 'Poșta Română';
    private const RUSSIA_POST = 'Russia Post';
    private const SINGAPORE_POST = 'Singapore Post';
    private const SLOVENSKA_POSTA = 'Slovenská pošta';
    private const POSTA_SLOVENIJE = 'Pošta Slovenije';
    private const SOUTH_AFRICAN_POST_OFFICE = 'South African Post Office';
    private const CORREOS = 'Correos';
    private const POSTNORD = 'PostNord';
    private const SWISS_POST = 'Swiss Post';
    private const CHUNGHWA_POST = 'Chunghwa Post';
    private const THAILAND_POST = 'Thailand Post';
    private const PTT = 'PTT';
    private const ROYAL_MAIL = 'Royal Mail';
    private const CORREO_URUGUAYO = 'Correo Uruguayo';
    private const USPS = 'USPS';

    private const FINAL_MILE_CARRIERS = [
        'AR' => ['name' => self::CORREO_ARGENTINO, 'url' => 'https://www.correoargentino.com.ar/formularios/oidn'],
        'AU' => ['name' => self::AUSTRALIA_POST, 'url' => 'https://auspost.com.au/mypost/track/#/details/%s'],
        'AT' => ['name' => self::OSTERREICHISCHE_POST, 'url' => 'https://www.post.at/sv/sendungsdetails?snr=%s'],
        'BE' => [
            'name' => self::BPOST,
            'url'  => 'https://track.bpost.cloud/btr/web/#/search?lang=fr&itemCode=%s&postalCode=3080',
        ],
        'BR' => ['name' => self::CORREIOS_DE_BRASIL, 'url' => 'https://rastreamento.correios.com.br/app/index.php'],
        'BG' => [
            'name' => self::BULGARIAN_POSTS,
            'url'  => 'https://www.bgpost.bg/IPSWebTracking/IPSWeb_item_events.asp?itemid=%s&submit=Follow',
        ],
        'CA' => [
            'name' => self::CANADA_POST,
            'url'  => 'https://www.canadapost-postescanada.ca/track-reperage/en#/details/%s',
        ],
        'CL' => [
            'name' => self::CORREOS_CHILE,
            'url'  => 'https://www.correos.cl/web/guest/seguimiento-en-linea?codigos=%s#0',
        ],
        'HR' => ['name' => self::HRVATSKA_POSTA, 'url' => 'https://posiljka.posta.hr/Tracking/Details?Barcode=%s'],
        'CY' => [
            'name' => self::CYPRUS_POST,
            'url'  => 'https://ips.cypruspost.gov.cy/ipswebtrack/IPSWeb_item_events.aspx?itemid=%s&Submit=Submit',
        ],
        'CZ' => [
            'name' => self::CESKA_POSTA,
            'url'  => 'https://www.postaonline.cz/en/trackandtrace/-/zasilka/cislo?parcelNumbers=%s',
        ],
        'DK' => ['name' => self::POSTNORD, 'url' => 'https://www.postnord.dk/varktojer/track-trace'],
        'EG' => [
            'name' => self::EGYPT_POST,
            'url'  => 'https://www.egyptpost.org/track-details?itemReference=%s&as_fid=675b5568121a827a35964e8bfd8b4e83c0cf7c4d',
        ],
        'EE' => ['name' => self::OMNIVA, 'url' => 'https://www.omniva.ee/abi/jalgimine'],
        'FI' => ['name' => self::POSTI, 'url' => 'https://www.posti.fi/en/tracking#/lahetys/%s?lang=en'],
        'FR' => ['name' => self::LE_GROUPE_LA_POSTE, 'url' => 'https://www.laposte.fr/outils/suivre-vos-envois'],
        'DE' => ['name' => self::DEUTSCHE_POST, 'url' => 'https://www.deutschepost.de/sendung/simpleQueryResult.html'],
        'GH' => ['name' => self::GHANA_POST, 'url' => 'https://tools.v2.ghanapost.com.gh/toolsv1/'],
        'GR' => ['name' => self::ELTA, 'url' => 'https://itemsearch.elta.gr/en-GB/Query/Direct/%s'],
        'HK' => ['name' => self::HONGKONG_POST, 'url' => 'https://webapp.hongkongpost.hk/en/mail_tracking/index.html'],
        'HU' => ['name' => self::MAGYAR_POSTA, 'url' => 'https://www.posta.hu/nyomkovetes/nyitooldal?searchvalue=%s'],
        'IS' => [
            'name' => self::ICELAND_POST,
            'url'  => 'https://posturinn.is/en/individuals/receive/track-shipment/?q=%s',
        ],
        'IN' => [
            'name' => self::INDIA_POST,
            'url'  => 'https://www.indiapost.gov.in/_layouts/15/DOP.Portal.Tracking/TrackConsignment.aspx',
        ],
        'ID' => ['name' => self::POS_INDONESIA, 'url' => 'https://www.posindonesia.co.id/en/tracking'],
        'IE' => ['name' => self::AN_POST, 'url' => 'https://www.anpost.com/'],
        'IT' => [
            'name' => self::POSTE_ITALIANE,
            'url'  => 'https://www.poste.it/cerca/index.html#/risultati-spedizioni/%s',
        ],
        'JP' => [
            'name' => self::JAPAN_POST,
            'url'  => 'https://trackings.post.japanpost.jp/services/srv/search/direct?reqCodeNo1=%s&searchKind=S002&locale=ja',
        ],
        'KP' => [
            'name' => self::KOREA_POST,
            'url'  => 'https://service.epost.go.kr/trace.RetrieveEmsRigiTraceList.comm?POST_CODE=%s&displayHeader=N',
        ],
        'LV' => ['name' => self::LATVIJAS_PASTS, 'url' => 'https://www.pasts.lv/en/Category/Tracking_of_Postal_Items/'],
        'LT' => ['name' => self::LIETUVOS_PASTAS, 'url' => 'https://old.post.lt/en/help/parcel-search'],
        'LU' => [
            'name' => self::POSTLUXEMBOURG,
            'url'  => 'https://www.post.lu/en/particuliers/colis-courrier/track-and-trace#/result',
        ],
        'MY' => ['name' => self::POS_MALAYSIA, 'url' => 'https://parcelsapp.com/en/tracking/%s'],
        'MT' => ['name' => self::MALTA_POST, 'url' => 'https://www.maltapost.com/tracking#/tracking'],
        'MX' => [
            'name' => self::MEXICO,
            'url'  => 'https://www.correosdemexico.gob.mx/SSLServicios/SeguimientoEnvio/seguimientoportal2.aspx?guia=%s',
        ],
        'NL' => ['name' => self::POSTNL, 'url' => 'https://postnl.post/'],
        'NZ' => ['name' => self::NEW_ZEALAND_POST, 'url' => 'https://www.nzpost.co.nz/tools/tracking'],
        'NG' => ['name' => self::NIGERIAN_POSTAL_SERVICE, 'url' => 'https://www.nipost.gov.ng/Track_Trace'],
        'NO' => ['name' => self::POSTEN_NORGE, 'url' => 'https://sporing.posten.no/sporing/%s?lang=no'],
        'PH' => ['name' => self::PHLPOST, 'url' => 'https://www.phlpost.gov.ph/'],
        'PL' => ['name' => self::POCZTA_POLSKA, 'url' => 'https://emonitoring.poczta-polska.pl/'],
        'PT' => [
            'name' => self::CTT,
            'url'  => 'https://www.ctt.pt/feapl_2/app/open/objectSearch/objectSearch.jspx?lang=def',
        ],
        'RO' => ['name' => self::POSTA_ROMANA, 'url' => 'https://www.posta-romana.ro/track-trace.html'],
        'RU' => ['name' => self::RUSSIA_POST, 'url' => 'https://www.pochta.ru/tracking#%s'],
        'SG' => ['name' => self::SINGAPORE_POST, 'url' => 'https://www.singpost.com/send-receive/receive-mail-parcel'],
        'SK' => ['name' => self::SLOVENSKA_POSTA, 'url' => 'https://tandt.posta.sk/'],
        'SI' => ['name' => self::POSTA_SLOVENIJE, 'url' => 'https://sledenje.posta.si/'],
        'ZA' => ['name' => self::SOUTH_AFRICAN_POST_OFFICE, 'url' => 'http://globaltracktrace.ptc.post/gtt.web/'],
        'ES' => [
            'name' => self::CORREOS,
            'url'  => 'https://www.correos.es/es/es/herramientas/localizador/envios/detalle?tracking-number=%s',
        ],
        'SE' => [
            'name' => self::POSTNORD,
            'url'  => 'https://www.postnord.se/vara-verktyg/spara-brev-paket-och-pall?shipmentId=%s',
        ],
        'CH' => ['name' => self::SWISS_POST, 'url' => 'https://service.post.ch/ekp-web/ui/list'],
        'TW' => [
            'name' => self::CHUNGHWA_POST,
            'url'  => 'https://postserv.post.gov.tw/pstmail/main_mail.html?targetTxn=%s',
        ],
        'TH' => ['name' => self::THAILAND_POST, 'url' => 'https://track.thailandpost.co.th/'],
        'TR' => ['name' => self::PTT, 'url' => 'https://gonderitakip.ptt.gov.tr/Track/Result'],
        'GB' => ['name' => self::ROYAL_MAIL, 'url' => 'https://www.royalmail.com/track-your-item#/tracking-results/%s'],
        'UY' => ['name' => self::CORREO_URUGUAYO, 'url' => 'https://www.correo.com.uy/seguimientodeenvios'],
        'US' => [
            'name' => self::USPS,
            'url'  => 'https://tools.usps.com/go/TrackConfirmAction?tRef=fullpage&tLc=2&text28777=&tLabels=%s%2C&tABt=false',
        ],
    ];

    /**
     * @throws CarrierNotSupportedException
     */
    public function __construct(private string $countryCode, private string $trackingCode)
    {
        if (!in_array($this->countryCode, array_keys(self::FINAL_MILE_CARRIERS))) {
            throw new CarrierNotSupportedException($this->countryCode);
        }
        $finalMileCarrier = self::FINAL_MILE_CARRIERS[$this->countryCode];

        $this->name = $finalMileCarrier['name'];
        $this->url = sprintf($finalMileCarrier['url'], $this->trackingCode);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getTrackingCode(): string
    {
        return $this->trackingCode;
    }
}
