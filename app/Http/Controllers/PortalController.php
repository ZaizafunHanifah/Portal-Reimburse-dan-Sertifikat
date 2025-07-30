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
                    'IMDG CODE', 'CMT', 'CMHBT', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
                ],
                'MUALIM I' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                    'IMDG CODE', 'CMT', 'CMHBT', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
                ],
                'MUALIM II Sr & Yr' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                    'IMDG CODE', 'CMT', 'CMHBT', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
                ],
                'MUALIM III Sr & Yr' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                    'IMDG CODE', 'CMT', 'CMHBT', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
                ],
                'MUALIM IV Sr & Yr' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                    'IMDG CODE', 'CMT', 'CMHBT', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
                ],

                // Dokter & Perawat
                'DOKTER' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CMT', 'CMHBT', 'STR/SIP'
                ],
                'PERAWAT' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CMT', 'CMHBT', 'STR/SIP'
                ],

                // Bintara Tamtama Deck
                'SERANG' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING ABLE DEK'
                ],
                'TANDIL' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING DEK'
                ],
                'PANJARWALA' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING DEK'
                ],
                'MISTRI' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING DEK'
                ],
                'KELASI' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING DEK'
                ],
                'KASAP DEK' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING DEK'
                ],
                'JURU MUDI' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING DEK'
                ],

                // Perwira Mesin
                'KKM' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CMT', 'CMHBT', 'COC', 'COE'
                ],
                'MASINIS I Sr' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CMT', 'CMHBT', 'COC', 'COE'
                ],
                'MASINIS I Yr' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CMT', 'CMHBT', 'COC', 'COE'
                ],
                'MASINIS II' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CMT', 'CMHBT', 'COC', 'COE'
                ],
                'MASINIS III' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CMT', 'CMHBT', 'COC', 'COE'
                ],
                'MASINIS IV' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CMT', 'CMHBT', 'COC', 'COE'
                ],

                // Bintara Tamtama Mesin
                'JURU MOTOR' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING ABLE ENGINE'
                ],
                'MANDOR MESIN' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING ABLE ENGINE'
                ],
                'PANDAI BESI' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING ABLE ENGINE'
                ],
                'KASAP MESIN' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING ENGINE'
                ],
                'JURU MINYAK' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING ENGINE'
                ],
                'TUKANG ANGSUR' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING ENGINE'
                ],

                // Pelayanan & Permakanan
                'JENANG PERAKIT' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CMT', 'CMHBT'
                ],
                'MASAK' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CMT', 'CMHBT'
                ],
                'JURU MASAK' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CMT', 'CMHBT'
                ],
                'KEPALA PELAYAN' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CMT', 'CMHBT'
                ],
                'PELAYAN' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CMT', 'CMHBT'
                ],

                // Markonis & Elektrik
                'PERWIRA RADIO' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CMT', 'CMHBT', 'SRE II'
                ],
                'ITTO' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CMT', 'CMHBT', 'ETO'
                ],
                'AHLI LISTRIK' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CMT', 'CMHBT', 'ETO/ETR'
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
                    'IMDG CODE', 'CMT', 'CMHBT', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
                ],
                'MUALIM I' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                    'IMDG CODE', 'CMT', 'CMHBT', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
                ],
                'MUALIM II Sr & Yr' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                    'IMDG CODE', 'CMT', 'CMHBT', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
                ],
                'MUALIM III Sr & Yr' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                    'IMDG CODE', 'CMT', 'CMHBT', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
                ],
                'MUALIM IV Sr & Yr' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'BRM', 'RADAR', 'ARPA', 'ECDIS', 'SSO',
                    'IMDG CODE', 'CMT', 'CMHBT', 'ORU', 'COC', 'COE', 'GMDSS Operator', 'ENDORSE GMDSS'
                ],

                // Dokter & Perawat
                'DOKTER' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CMT', 'CMHBT', 'STR/SIP'
                ],
                'PERAWAT' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CMT', 'CMHBT', 'STR/SIP'
                ],

                // Bintara Tamtama Deck
                'SERANG' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING ABLE DEK'
                ],
                'TANDIL' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING DEK'
                ],
                'PANJARWALA' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING DEK'
                ],
                'MISTRI' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING DEK'
                ],
                'KELASI' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING DEK'
                ],
                'KASAP DEK' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING DEK'
                ],
                'JURU MUDI' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING DEK'
                ],

                // Perwira Mesin
                'KKM' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CMT', 'CMHBT', 'COC', 'COE'
                ],
                'MASINIS I Sr' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CMT', 'CMHBT', 'COC', 'COE'
                ],
                'MASINIS I Yr' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CMT', 'CMHBT', 'COC', 'COE'
                ],
                'MASINIS II' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CMT', 'CMHBT', 'COC', 'COE'
                ],
                'MASINIS III' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CMT', 'CMHBT', 'COC', 'COE'
                ],
                'MASINIS IV' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'ERM', 'MHV', 'SSO', 'CMT', 'CMHBT', 'COC', 'COE'
                ],

                // Bintara Tamtama Mesin
                'JURU MOTOR' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING ABLE ENGINE'
                ],
                'MANDOR MESIN' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING ABLE ENGINE'
                ],
                'PANDAI BESI' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING ABLE ENGINE'
                ],
                'KASAP MESIN' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING ENGINE'
                ],
                'JURU MINYAK' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING ENGINE'
                ],
                'TUKANG ANGSUR' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'SDSD', 'CMT', 'CMHBT', 'RATING FORMING ENGINE'
                ],

                // Pelayanan & Permakanan
                'JENANG PERAKIT' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CMT', 'CMHBT'
                ],
                'MASAK' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CMT', 'CMHBT'
                ],
                'JURU MASAK' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CMT', 'CMHBT'
                ],
                'KEPALA PELAYAN' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CMT', 'CMHBT'
                ],
                'PELAYAN' => [
                    'BST', 'SCRB', 'AFF', 'MFA', 'SAT', 'CMT', 'CMHBT'
                ],

                // Markonis & Elektrik
                'PERWIRA RADIO' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CMT', 'CMHBT', 'SRE II'
                ],
                'ITTO' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CMT', 'CMHBT', 'ETO'
                ],
                'AHLI LISTRIK' => [
                    'BST', 'SCRB', 'AFF', 'MC', 'MFA', 'SAT', 'CMT', 'CMHBT', 'ETO/ETR'
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