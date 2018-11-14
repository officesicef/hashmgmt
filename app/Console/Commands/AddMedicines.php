<?php

namespace App\Console\Commands;

use App\Medicine;
use Illuminate\Console\Command;

class AddMedicines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AddMedicines:medicine';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $data = ['Aminofilin','Amoksicilin','Captopril','Cefaklor','Cilazapril','Clarithromycin','Diklofenak','Diprian','Eukaptil','Fromilid','Ibuprofen','Karvedilol','Marocen','Norvasc','Paracetamol','Povidon','Presolol','Ranitidin','Sinkum','TetrazepamMIP','Vasilip','Zerlon','Novi','Aminosol','Aminosol','Amoksicilin','Aqua','CefazolinMIP','Disoprivan','Edicin','Hepasol','Menopur','Natrii','Nexium','Pavulon','Ranitidin','Lekovi','Citeral','Efferalgan','Predian','Syncumar','Lekovi','Farcef','Lendacin','Menopur','Rocephin','Vancocin','Veracol','LISTA','Lekovi','abecednom','Aciklovir','Aciklovir','Activelle','Actrapid','Actrapid','Actrapid','Actrapid','Afloderm','Alendronat','Alfacet','Alfacet','Alkeran','Alopres','Aloprol','Alopurinol','Alpha','Alphapres','Amaryl','Aminofilin','Aminofilin','Amiodaron','Amlodipin','Amlopin','Amoksicilin','Amoksicilin','Amoksiklav','Amoksiklav','Anafranil','Andriol','Androcur','Angiazem','Artane','Arucid','Atenolol','Atenolol','Atenolol','Atrican','Atropin','Auromid','Bactimol','Bactrim','Becenol','Becloforte','Beconase','Becotide','Beglynor','Bensedin','Berodual','Bimenal','Bimepen','Bioprim','Bivacyn','Boluzin','Bromazepam','Bromokriptin','Brufen','Bumenid','Bumetanid','Captopril','Cefaklor','Cefaleksin','Cefaleksin','Cefalexin','CellCept','Chloramphenicol','Cholipam','Cicloral','Cilazapril','Ciprocinal','Ciprofloksacin','Ciprofloksacin','Cisap','Citeral','Clarithromycin','Cliacil','Climen','Clomifene','Closapine','Colpocin','Combivir','Concor','Controloc','Cornilat','Cortiazem','Crixivan','Cyclo','Dabroston','Daktanol','Daonil','Dexamethasonneomycin','Dexason','Diamox','Diane','Diazepam','Diazepam','Diazepam','Diazepam','Diazepam','Diazepam','Diclofenac','Difutrat','Digoxin','Diklofen','Diklofenak','Diklofenak','Diklofenak','Dikonazol','Dilacor','Dilatrend','Diltiazem','Dimekor','Diprian','Diunorm','Doksiciklin','Doksiciklin','Doksiciklin','Dovicin','Dugen','Durofilin','Durogesic','Efectin','Efferalgan','Eftil','Eftil','Enalapril','Enalapril','Enbecin','Epivir','Eritromicin','Eritromicin','Eritromicin','Eritromicin','Esperal','Esperson','Esperson','Esperson','Eukaptil','Euthyrox','Famotidin','Farin','Febricet','Fenobarbiton','Ferro','Festal','Flixotide','Flormidal','Fluconal','Flufenazin','Flugalin','Flukonazol','Flunirin','Flunisan','Fluorogal','Folan','Folnak','Fortovase','Frilavon','Fromilid','Furosemid','Galadrox','Galitifen','Gamex','Genotropin','Gentamicin','Gentokulin','Gino','Glaumol','Glibenese','Glibenklamid','Gliceriltrinitrat','Glikosan','Glioral','GlucaGen','Glucophage','Glucotrol','Gluformin','Haloperidol','Haloperidol','Heferol','Hemokvin','Hemomycin','Hemopres','Hloramfenikol','Hloramkol','Hydrocortison','Ibuprofen','Ibuprofen','Ibuprofen','Imuprin','Imuran','Insulatard','Insulatard','Insulatard','Insulin','Insulin','Insuman','Insuman','Insuman','Insuman','Insuman','Insuman','Insuman','Inutral','Inutral','Isofan','Isoniazid','Isosorb','Izomonit','Izopamil','Juprenil','Kalcijum','Kaletra','Kalijum','Kaliumiodid','Kanazol','Karbamazepin','Karbapin','Karvedilol','Karvileks','Katopil','Klindamicin','Kliogest','Klometol','Klomifen','Kodein','Ksalol','LactuloseMIP','Lamictal','Lantus','Lantus','Largactil','Lasix','Legofer','Legravan','Lemod','Leponex','Lesux','Letrox','Leukeran','Lidokain','Lipanor','Litijum','Lizinopril','Logest','Lometazid','Loperamid','Loradin','Loram','Loratadin','Lorazepam','Loril','Loseprazol','Madopar','Madopar','Madopar','Maprotilin','Maprotin','Marocen','Mebendazol','Medrol','Mendilex','Mercilon','MEslon','Mestinon','Metadon','Methotrexat','Methotrexat','Methyldopa','Methylergometrin','Metildopa','Metoten','Miansan','Milenol','Minirin','Minsetil','Miokarpin','Miralgin','Mixtard','Mixtard','Mixtard','Mixtard','Mixtard','Mixtard','Mixtard','Mixtard','Mixtard','Monizol','Monodipin','Monopril','Monosan','Monotard','Monotard','Movalis','Myambutol','Mycoseb','Myleran','Myolastan','Naksetol','Naproksen','Naproxen','Neodeksacin','Neotigason','Nifedipin','Nifedipin','Nifelat','Nifelat','Nipidin','Nirmin','Nirypan','Nitroglicerin','Nitropen','Nolvadex','Norditropin','Norditropin','Norvasc','NovoMix','NovoNorm','NovoRapid','Nystatin','Omeprol','Omezol','Ondasan','Orvagil','Orvagil','Orvagil','Palitrex','Panapres','Panklav','Pankreatin','Panolon','Paracet','Paracetamol','Paracetamol','Paracetamol','Phenergan','Phenobarbiton','Pipegal','Pipem','PK','Plavix','Portalak','Povidon','Povidon','Povidon','Predian','Prednison','Prednizon','Premarin','Presolol','Pressing','Prexanil','Prilazid','Prilenap','Prilenap','Prilenap','Prinorm','Profenan','Prograf','Pronison','Propafen','Propranolol','Prostanorm','PTU','Pulmozyme','Puri','Ranisan','Ranital','Ranitidin','Ranitidin','Ranitidin','Ranitidin','Ranitidin','Ransana','Rapamune','Rapten','Rekafarm','Retrovir','Rifamor','Riftan','Rispolept','Rissar','Rivotril','Roaccutane','Rocaltrol','Roxikam','Roximisan','Runac','Salazopyrin','Salbutamol','Salofalk','Sanaderm','Sandimmun','Sanicet','Sedabenz','Sedacoron','Serevent','Sinacilin','Sinkum','Sinelip','Sinoderm','Sinoderm','Sintradon','Siofor','Sirdalud','Soltrik','Sortis','Spalmotil','Spironolakton','Stadipin','Stanicid','Stediril','Stilnox','Stocrin','Suxinutin','Syncumar','Tamoxifen','Tamoxifen','Tefor','Tegretol','Tegretol','Tetrakain','Tetrazepam','Tiastat','Ticlodix','Tilzem','Timadren','Timolol','Tivoral','Topamax','Tramadol','Trimosazol','Trimosul','Trisequens','Tritace','Trixifen','Trizivir','Trodon','Turganil','Uniclophen','Unitimolol','Ursofalk','Vasilip','Vazotal','Velosulin','Ventolin','Vepamil','Vepesid','Verapamil','Verapamil','Verapamil','Videx','Vigantol','Viracept','Viramune','Visiren','Vitamin','Xalatan','Yurinex','Zaxan','Zeffix','Zerit','Zerlon','Ziagen','Zidosan','Zodol','Zoloft','Zorkaptil','Zovirax','OGRANIČENJA','predlog','gastroezofagealnu','gastroenterologa','na','gastroenterologa','i','blokatorima','pacijenata','strane','koji','endokrinologa','nezadovoljavajućom','kliničke','mišljenja','glikoregilacijom','Diabetes','endokrinologa.','su','događaja)','mišljenja','u','bolesnika.','lečenje','dermatologa','prevenciju','rezistentne','reumatolog','bubrega','metabolizmom','donora','teške','konzilijarno','ulkusnom','na','osteoporoza','analgetičkoj','kancerskog','oralnim','nisu','maligne','maligne','titriranje','trigeminalna','spondilodiscitis','analgetičkih','konzilijarnog','osnovu','odgovora','dejstva','sindrom).','stadijum)','ustanove','(MKB','mišljenja','LISTA','Lekovi','redu','ActHIB','Adrenalin','Adriblastina','Aimafix','AldipeteT','Alopurinol','Amikacin','Aminofilin','Aminofilin','Aminofilin','Aminophyllinum','Aminosol','Aminosol','Aminosteril','Aminosteril','Aminosteril','Aminosteril','Amoksicilin','Amoksiklav','Amphotericin','Anafranil','Anexate','Aqua','Aqua','Arucid','Atebulin','Atropin','Avessa','Azaran','Bactrim','Barijum','BCGT','Bedoxin','Bensedin','Beoglobin','čenje','Beriate','Beriplast','Beviplex','Biliscopin','Bumenid','Buscopan','Calcium','Calciumfolinat','Carboplatin','Carboplatin','CefazolinMIP','Ciprocinal','Cisap','čenje','Cisplatin','Cisplatin','Clexane','Clivarin','Controloc','Curosurf','CycloGal','Cycloplatin','Cymevene','Cytosar','Cytoxan','Dacarbazin','Daunoblastina','Deticene','Dexason','Diflucan','Diklofen','Diklofenak','Dikonazol','Dilacor','Dilan','Dimekor','Disoprivan','Dopamin','Doxorubicin','Dugen','Dysport','Ebrantil','Edicin','Emoclot','Emosint','Endobulin','EngerixB','Epirubicin','Eprex','Eprex','Eprex','Eprex','Eprex','Esmeron','Etoposid','Etoposide','Euphylong','Euvax','Euvax','Factor','Farcef','Farmorubicin','Febricet','Fedex','Fentanyl','Festal','Fibrolan','Fiziološki','Fiziološki','Flormidal','Fluarix','Forane','Forcas','Fortrans','Fragmin','Fraxiparine','Fuzeon','Gadovist','Galecef','Gamma','Gentamicin','Gentamicin','Gentamicin','Gentamicin','Glucosi','Glucosi','Glukoza','Gonal','Haemaccel','Haemate','Haemoctin','Haldol','Haloperidol','Haloperidol','Halothan','Hartmanov','Hartmanov','Hartmanov','Heparin','Hepasol','Hepasteril','Hiberix','Hidrokortizon','Human','Human','Human','Humani','Humani','Humani','Hydrocortison','Hypnomidate','Ig','Immunate','Immunine','Immunorho','Imogam','Imovax','Imovax','Infanrix','Intralipid','Intron','Izopamil','Jugocillin','Kabiven','Kabivien','Klindamicin','Klometol','Konakion','Kytril','Lasix','Lemod','Lemod','Lendacin','Leucovorin','Levuloza','Lidocaine','Lidokain','Lidokain','Lipovenoes','Ljudski','Longaceph','Lorazepam','Losec','Magnevist','Manitol','Manitol','Manitol','Marcaine','Marcaine','Marcaine','Marocen','Maxicef','Medophenicol','Menopur','Menopur','Meronem','Methotrexat','Methotrexat','Methotrexate','Methylergometrin','Midarine','Minsetil','Miralgin','Moditen','Morphini','Movalis','čenja','Mutamycin','Natrii','Natrii','Natrii','Natrii','Natrii','Natrii','Natrijum','Natrijum','Natriumbicarbonat','Neostigmin','Neupogen','Nexium','Nilacef','Nimotop','Nirmin','Nirypan','Norcuron','Novalgetol','NovoSeven','Octagam','Octanate','Octanine','OHB','Omnipaque','Omnipaque','Ondasan','Optiray','Optiray','OPVT','Orvagil','Oxytocine','Pancillin','Pancuronium','Paracetamol','Paracetamol','ParaGal','Paraplatin','Partobulin','Partusisten','Pavulon','Pentrexyl','Phenobarbiton','PK','Platidiam','PlatiGal','Platinex','Povidon','Povidon','PPDT','Pregnyl','Prepidil','Presolol','Propafen','Propafenon','Propofol','(','Prostin','Prostin','Protamin','Ranisan','Ranital','Ranitidin','Ranitidin','Rapifen','Recofol','Recormon','Reglan','Reohem','Resovist','Rhesogamma','Ringerov','Ringerov','Rispolept','Rivotril','Rocephin','Roferon','Sandimmun','Sandostatin','Scanlux','Scanlux','Sedacoron','Sevorane','Sintradon','Sodium','Soluvit','Streptase','Streptomycin','Syntocinon','Targocid','Tauredon','Tazocin','Testosteron','Tetabulin','Tetagam','Tetanus','TetavaksalT','Tienam','Tissucol','Tolycar','Tracrium','Tramadol','Trimovax','Tripacel','Trodon','Ultravist','Ultravist','Ultravist','Uman','Urografin','Vakcina','Vakcina','Vakcina','Vaminolact','Vancocin','VancomycinMIP','Vaxigrip','Vaxigrip','Venimmun','VepeGal', 'Vepesid','Veracol','Verapamil','Vexelit','Vialebex','Viekvin','Vinblastine','Vincristine','Vincristine','Vitamin'];

        //Initiate Multiple Thread
        foreach ($data as $item) {
            $response = file_get_contents("https://mediately.co/api/v4/drugs/rs?query=$item&page=1&search=all");
            $resp =  json_decode($response, true)['drugs'];

                foreach ($resp as $i) {

                    if (Medicine::where('registration_id', $i['registration_id'])->first()) continue;

                    $med = new Medicine();
                    $med->slug = $i['slug'];
                    $med->registration_id = $i['registration_id'];
                    $med->registered_name = $i['registered_name'];
                    $med->pharmaceutical_form = $i['pharmaceutical_form'];
                    $med->issuing_desc = $i['issuing_desc'];
                    $med->license_holder = $i['license_holder'];
                    $med->save();
            }
        }
    }
}
