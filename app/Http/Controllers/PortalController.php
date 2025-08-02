<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sertifikat;
use App\Models\SertifikatNonPso;

class PortalController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function sertifikat(Request $request)
    {
        $nrp = $request->input('nrp');

        $pelaut = null;
        $sertifikat = collect();

        if ($nrp) {
            $pelaut = Sertifikat::where('nrp', $nrp)->first();
            $sertifikat = Sertifikat::where('nrp', $nrp)->get();
        }

        $wajibSertifikat = [ 
            // Perwira Deck
            'NAKHODA' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],
            'MUALIM I' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],
            'MUALIM II' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],
            'MUALIM II Sr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],
            'MUALIM II Yr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],
            'MUALIM III' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],
            'MUALIM III Sr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],
            'MUALIM III Yr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],
            'MUALIM IV' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],

            // Dokter & Perawat
            'DOKTER' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'STR/SIP'
            ],
            'PERAWAT' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'STR/SIP'
            ],
            'PUK I' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'PUK II' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'PUK III' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],

            // Bintara Tamtama Deck
            'SERANG' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING ABLE DEK'
            ],
            'TANDIL' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING DEK'
            ],
            'PANJARWALA' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING DEK'
            ],
            'MISTRI I' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING DEK'
            ],
            'KELASI' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING DEK'
            ],
            'KASAP DEK' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING DEK'
            ],
            'JURU MUDI' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING DEK'
            ],

            // Perwira Mesin
            'KKM' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS I Sr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS I Yr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS I' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS II' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS III' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS III Sr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS III Yr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS IV' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS IV Sr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS IV Yr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],

            // Bintara Tamtama Mesin
            'JURU MOTOR' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING ABLE ENGINE'
            ],
            'MANDOR MESIN' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING ABLE ENGINE'
            ],
            'PANDAI BESI' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING ABLE ENGINE'
            ],
            'KASAP MESIN' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING ENGINE'
            ],
            'JURU MINYAK' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING ENGINE'
            ],
            'TUKANG ANGSUR' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING ENGINE'
            ],

            // Pelayanan & Permakanan
            'JENANG' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'JENANG I' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'JENANG II' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'JENANG III' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'PERAKIT MASAK' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'JURU MASAK' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'PELAYAN KEPALA' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'PELAYAN' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'PENATU' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],

            // Markonis & Elektrik
            'PERWIRA RADIO I' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'SRE II'
            ],
            'PERWIRA RADIO II' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'SRE II'
            ],
            'ITTO' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'ETO'
            ],
            'ETO' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'ETO'
            ],
            'AHLI LISTRIK I' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'ETO/ETR'
            ],
            'AHLI LISTRIK II' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'ETO/ETR'
            ],
            'AHLI LISTRIK III' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'ETO/ETR'
            ]
        ];


        $jabatan = strtoupper(trim($pelaut->jabatan ?? ''));
        $sertifikatWajib = [];
        if ($jabatan && isset($wajibSertifikat[$jabatan])) {
            $sertifikatWajib = $wajibSertifikat[$jabatan];
        }

        return view('sertifikat.index', compact('pelaut', 'sertifikat', 'sertifikatWajib'));
    }

    public function reimburse(Request $request)
    {
        $noSertifikat = $request->input('no_sertifikat');

        $data = null;
        if ($noSertifikat) {
            $data = Sertifikat::where('nomor_sertifikat', $noSertifikat)
                  ->where('source', 'reimburse') 
                  ->first();
        }

        return view('reimburse.index', compact('data'));
    }

    public function sertifikatNonPso(Request $request)
    {
        $nik = $request->input('nik');
        $pelaut = null;
        $sertifikat = collect();

        if ($nik) {
            $pelaut = SertifikatNonPso::whereRaw('TRIM(nik) = ?', [$nik])->first();
            $sertifikat = SertifikatNonPso::whereRaw('TRIM(nik) = ?', [$nik])->get();
        }

        $wajibSertifikat = [ 
            // Perwira Deck
            'NAKHODA' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],
            'MUALIM I' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],
            'MUALIM II' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],
            'MUALIM II Sr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],
            'MUALIM II Yr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],
            'MUALIM III' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],
            'MUALIM III Sr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],
            'MUALIM III Yr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],
            'MUALIM IV' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                'IMDG CODE', 'CROWD', 'CRISIS', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
            ],

            // Dokter & Perawat
            'DOKTER' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'STR/SIP'
            ],
            'PERAWAT' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'STR/SIP'
            ],
            'PUK I' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'PUK II' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'PUK III' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],

            // Bintara Tamtama Deck
            'SERANG' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING ABLE DEK'
            ],
            'TANDIL' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING DEK'
            ],
            'PANJARWALA' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING DEK'
            ],
            'MISTRI I' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING DEK'
            ],
            'KELASI' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING DEK'
            ],
            'KASAP DEK' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING DEK'
            ],
            'JURU MUDI' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING DEK'
            ],

            // Perwira Mesin
            'KKM' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS I Sr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS I Yr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS I' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS II' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS III' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS III Sr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS III Yr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS IV' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS IV Sr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],
            'MASINIS IV Yr' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CROWD', 'CRISIS', 'COC', 'COE'
            ],

            // Bintara Tamtama Mesin
            'JURU MOTOR' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING ABLE ENGINE'
            ],
            'MANDOR MESIN' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING ABLE ENGINE'
            ],
            'PANDAI BESI' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING ABLE ENGINE'
            ],
            'KASAP MESIN' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING ENGINE'
            ],
            'JURU MINYAK' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING ENGINE'
            ],
            'TUKANG ANGSUR' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CROWD', 'CRISIS', 'RATING FORMING ENGINE'
            ],

            // Pelayanan & Permakanan
            'JENANG' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'JENANG I' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'JENANG II' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'JENANG III' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'PERAKIT MASAK' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'JURU MASAK' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'PELAYAN KEPALA' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'PELAYAN' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],
            'PENATU' => [
                'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CROWD', 'CRISIS'
            ],

            // Markonis & Elektrik
            'PERWIRA RADIO I' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'SRE II'
            ],
            'PERWIRA RADIO II' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'SRE II'
            ],
            'ITTO' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'ETO'
            ],
            'ETO' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'ETO'
            ],
            'AHLI LISTRIK I' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'ETO/ETR'
            ],
            'AHLI LISTRIK II' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'ETO/ETR'
            ],
            'AHLI LISTRIK III' => [
                'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CROWD', 'CRISIS', 'ETO/ETR'
            ]
        ];

        $jabatan = strtoupper(trim($pelaut->jabatan ?? ''));
        $sertifikatWajib = [];
        if ($jabatan && isset($wajibSertifikat[$jabatan])) {
            $sertifikatWajib = $wajibSertifikat[$jabatan];
        }

        return view('sertifikat.index_nonpso', compact('pelaut', 'sertifikat', 'sertifikatWajib'));
    }
}