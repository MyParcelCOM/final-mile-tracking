<?php

declare(strict_types=1);

namespace MyParcelCom\TrackingModule\CarrierCode;

use MyParcelCom\TrackingModule\CarrierCode\Exception\CarrierNotSupportedException;

class CarrierCode
{
    private const CORREO_ARGENTINO = 'Correo Argentino';
    private const AUSTRALIA_POST = 'Australia Post';
    private const ÖSTERREICHISCHE_POST = 'Österreichische Post';
    private const BPOST = 'bpost';
    private const LANDMARK_GLOBAL = 'Landmark Global';
    private const CORREIOS_DE_BRASIL = 'Correios de Brasil';
    private const BULGARIAN_POSTS = 'Bulgarian Posts';
    private const CANADA_POST = 'Canada Post';
    private const CORREOS_CHILE = 'Correos Chile';
    private const HRVATSKA_POŠTA = 'Hrvatska pošta';
    private const CYPRUS_POST = 'Cyprus Post';
    private const ČESKÁ_POŠTA = 'Česká pošta';
    private const EGYPT_POST = 'Egypt Post';
    private const OMNIVA = 'Omniva';
    private const POSTI = 'Posti';
    private const LE_GROUPE_LA_POSTE = 'Le Groupe La Poste';
    private const COLISSIMO = 'Colissimo';
    private const DEUTSCHE_POST = 'Deutsche Post';
    private const DHL = 'DHL';
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
    private const LIETUVOS_PAŠTAS = 'Lietuvos paštas';
    private const POSTLUXEMBOURG = 'POSTLuxembourg';
    private const POS_MALAYSIA = 'Pos Malaysia';
    private const MALTA_POST = 'Malta Post';
    private const MEXICO = 'Correos De Mexico';
    private const POSTNL = 'PostNL';
    private const NEW_ZEALAND_POST = 'New Zealand Post';
    private const NIGERIAN_POSTAL_SERVICE = 'Nigerian Postal Service';
    private const POSTEN_NORGE = 'Posten Norge';
    private const BRING = 'Bring';
    private const PHLPOST = 'PHLPost';
    private const POCZTA_POLSKA = 'Poczta Polska';
    private const CTT = 'CTT';
    private const POȘTA_ROMÂNĂ = 'Poșta Română';
    private const RUSSIA_POST = 'Russia Post';
    private const SINGAPORE_POST = 'Singapore Post';
    private const SLOVENSKÁ_POŠTA = 'Slovenská pošta';
    private const POŠTA_SLOVENIJE = 'Pošta Slovenije';
    private const SOUTH_AFRICAN_POST_OFFICE = 'South African Post Office';
    private const CORREOS = 'Correos';
    private const POSTNORD = 'PostNord';
    private const SWISS_POST = 'Swiss Post';
    private const CHUNGHWA_POST = 'Chunghwa Post';
    private const THAILAND_POST = 'Thailand Post';
    private const PTT = 'PTT';
    private const ROYAL_MAIL = 'Royal Mail';
    private const PARCELFORCE = 'Parcelforce';
    private const CORREO_URUGUAYO = 'Correo Uruguayo';
    private const USPS = 'USPS';

    private const CARRIER_TRACKING_URLS = [
        self::CORREO_ARGENTINO          => 'https://www.correoargentino.com.ar/formularios/oidn',
        self::AUSTRALIA_POST            => 'https://auspost.com.au/mypost/track/#/details/%s',
        self::ÖSTERREICHISCHE_POST      => 'https://www.post.at/sv/sendungsdetails?snr=%s',
        self::BPOST                     => 'https://track.bpost.cloud/btr/web/#/search?lang=fr&itemCode=%s&postalCode=3080',
        self::LANDMARK_GLOBAL           => 'https://track.landmarkglobal.com/?trck=%s&Submit=Track',
        self::CORREIOS_DE_BRASIL        => 'https://rastreamento.correios.com.br/app/index.php',
        self::BULGARIAN_POSTS           => 'https://www.bgpost.bg/IPSWebTracking/IPSWeb_item_events.asp?itemid=%s&submit=Follow',
        self::CANADA_POST               => 'https://www.canadapost-postescanada.ca/track-reperage/en#/details/%s',
        self::CORREOS_CHILE             => 'https://www.correos.cl/web/guest/seguimiento-en-linea?codigos=%s#0',
        self::HRVATSKA_POŠTA            => 'https://posiljka.posta.hr/Tracking/Details?Barcode=%s',
        self::CYPRUS_POST               => 'https://ips.cypruspost.gov.cy/ipswebtrack/IPSWeb_item_events.aspx?itemid=%s&Submit=Submit',
        self::ČESKÁ_POŠTA               => 'https://www.postaonline.cz/en/trackandtrace/-/zasilka/cislo?parcelNumbers=%s',
        self::EGYPT_POST                => 'https://www.egyptpost.org/track-details?itemReference=%s&as_fid=675b5568121a827a35964e8bfd8b4e83c0cf7c4d',
        self::OMNIVA                    => 'https://www.omniva.ee/abi/jalgimine',
        self::POSTI                     => 'https://www.posti.fi/en/tracking#/lahetys/%s?lang=en',
        self::LE_GROUPE_LA_POSTE        => 'https://www.laposte.fr/outils/suivre-vos-envois',
        self::COLISSIMO                 => 'https://www.laposte.fr/outils/suivre-vos-envois',
        self::DEUTSCHE_POST             => 'https://www.deutschepost.de/sendung/simpleQueryResult.html',
        self::DHL                       => 'https://www.dhl.de/en/privatkunden/pakete-empfangen/verfolgen.html?piececode=%s&cid=dhlde',
        self::GHANA_POST                => 'https://tools.v2.ghanapost.com.gh/toolsv1/',
        self::ELTA                      => 'https://www.elta.gr/en-us/personal/tracktrace.aspx',
        self::HONGKONG_POST             => 'https://webapp.hongkongpost.hk/en/mail_tracking/index.html',
        self::MAGYAR_POSTA              => 'https://www.posta.hu/nyomkovetes/nyitooldal?searchvalue=%s',
        self::ICELAND_POST              => 'https://posturinn.is/en/individuals/receive/track-shipment/?q=%s',
        self::INDIA_POST                => 'https://www.indiapost.gov.in/_layouts/15/DOP.Portal.Tracking/TrackConsignment.aspx',
        self::POS_INDONESIA             => 'https://www.posindonesia.co.id/en/tracking',
        self::AN_POST                   => 'https://www.anpost.com/',
        self::POSTE_ITALIANE            => 'https://www.poste.it/cerca/index.html#/risultati-spedizioni/%s',
        self::JAPAN_POST                => 'https://trackings.post.japanpost.jp/services/srv/search/direct?reqCodeNo1=%s&searchKind=S002&locale=ja',
        self::KOREA_POST                => 'https://service.epost.go.kr/trace.RetrieveEmsRigiTraceList.comm?POST_CODE=%s&displayHeader=N',
        self::LATVIJAS_PASTS            => 'https://www.pasts.lv/en/Category/Tracking_of_Postal_Items/',
        self::LIETUVOS_PAŠTAS           => 'https://old.post.lt/en/help/parcel-search',
        self::POSTLUXEMBOURG            => 'https://www.post.lu/en/particuliers/colis-courrier/track-and-trace#/result',
        self::POS_MALAYSIA              => 'https://parcelsapp.com/en/tracking/%s',
        self::MALTA_POST                => 'https://www.maltapost.com/tracking#/tracking',
        self::MEXICO                    => 'https://www.correosdemexico.gob.mx/SSLServicios/SeguimientoEnvio/seguimientoportal2.aspx?guia=%s',
        self::POSTNL                    => 'https://postnl.post/',
        self::NEW_ZEALAND_POST          => 'https://www.nzpost.co.nz/tools/tracking',
        self::NIGERIAN_POSTAL_SERVICE   => 'https://www.nipost.gov.ng/Track_Trace',
        self::POSTEN_NORGE              => 'https://sporing.posten.no/sporing/%s?lang=no',
        self::BRING                     => 'https://sporing.posten.no/sporing/%s?lang=no',
        self::PHLPOST                   => 'https://www.phlpost.gov.ph/',
        self::POCZTA_POLSKA             => 'https://emonitoring.poczta-polska.pl/',
        self::CTT                       => 'https://www.ctt.pt/feapl_2/app/open/objectSearch/objectSearch.jspx?lang=def',
        self::POȘTA_ROMÂNĂ              => 'https://www.posta-romana.ro/track-trace.html',
        self::RUSSIA_POST               => 'https://www.pochta.ru/tracking#%s',
        self::SINGAPORE_POST            => 'https://www.singpost.com/send-receive/receive-mail-parcel',
        self::SLOVENSKÁ_POŠTA           => 'https://tandt.posta.sk/',
        self::POŠTA_SLOVENIJE           => 'https://sledenje.posta.si/',
        self::SOUTH_AFRICAN_POST_OFFICE => 'http://globaltracktrace.ptc.post/gtt.web/',
        self::CORREOS                   => 'https://www.correos.es/es/es/herramientas/localizador/envios/detalle?tracking-number=%s',
        self::POSTNORD                  => 'https://www.postnord.se/vara-verktyg/spara-brev-paket-och-pall?shipmentId=%s',
        self::SWISS_POST                => 'https://service.post.ch/ekp-web/ui/list',
        self::CHUNGHWA_POST             => 'https://postserv.post.gov.tw/pstmail/main_mail.html?targetTxn=%s',
        self::THAILAND_POST             => 'https://track.thailandpost.co.th/',
        self::PTT                       => 'https://gonderitakip.ptt.gov.tr/Track/Result',
        self::ROYAL_MAIL                => 'https://www.royalmail.com/track-your-item#/tracking-results/%s',
        self::PARCELFORCE               => 'https://www.parcelforce.com/contact-us',
        self::CORREO_URUGUAYO           => 'https://www.correo.com.uy/seguimientodeenvios',
        self::USPS                      => 'https://tools.usps.com/go/TrackConfirmAction?tRef=fullpage&tLc=2&text28777=&tLabels=%s%2C&tABt=false',
    ];

    public function __construct(private string $carrierCode)
    {
    }

    /**
     * @throws CarrierNotSupportedException
     */
    public function getUrl()
    {
        return in_array($this->carrierCode, array_keys(self::CARRIER_TRACKING_URLS)) ? self::CARRIER_TRACKING_URLS[$this->carrierCode] : throw new CarrierNotSupportedException($this->carrierCode);
    }
}
