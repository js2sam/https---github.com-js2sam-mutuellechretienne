<?php
function baremes($cat1,$cat2){
  //----------on verifie la sous categorie-----------
  $i=0;
  $j=0;
  $k=0;
  if ($cat2=='BRONZE') {
      # code...
      $i=0;
      $j=1;
      $k=0;
    }
  elseif ($cat2=='ARGENT') {
      # code...
      $i=2;
      $j=3;
      $k=1;
    }
  elseif ($cat2=='OR') {
      # code...
      $i=4;
      $j=5;
      $k=2;
    }
//----------on verifie la categorie-----------
  if ($cat1=='MASSAYA (90%)') {
    # code...
    $plafonds= array(
      array("<td>90%</td>","<td>150000</td>","<td>90%</td>","<td>300000</td>","<td>90%</td>","<td>Frais réels</td>"),
      array("<td>90%</td>","<td>150000</td>","<td>90%</td>","<td>300000</td>","<td>90%</td>","<td>Frais réels</td>"),
      array("<td>90%</td>","<td>150000</td>","<td>90%</td>","<td>300000</td>","<td>90%</td>","<td>Frais réels</td>"),
      array("<td>90%</td>","<td>150000</td>","<td>90%</td>","<td>300000</td>","<td>90%</td>","<td>Frais réels</td>"),
      array("<td>90%</td>","<td>150000</td>","<td>90%</td>","<td>300000</td>","<td>90%</td>","<td>Frais réels</td>"),
      array("<td>90%</td>","<td>150000</td>","<td>90%</td>","<td>300000</td>","<td>90%</td>","<td>Frais réels</td>"),
      array("<td>90%</td>","<td>50000</td>","<td>90%</td>","<td>50000</td>","<td>90%</td>","<td>Frais réels Tarif INHP</td>"),
      array("<td>90%</td>","<td>50000</td>","<td>90%</td>","<td>50000</td>","<td>90%</td>","<td>500 000 frs /personne /an</td>"),
      array("<td>90%</td>","<td>50000</td>","<td>90%</td>","<td>50000</td>","<td>90%</td>","<td>frais réels </td>"),
      array("<td></td>","<td>150000</td>","<td></td>","<td></td>","<td></td>","<td></td>"),
      array("<td>90%</td>","<td>80000</td>","<td>90%</td>","<td>160000</td>","<td>90%</td>","<td>250 000 FCFA/an/pers(voir observation)</td>"),
      array("<td>90%</td>","<td>80000</td>","<td>90%</td>","<td>160000</td>","<td>90%</td>","<td>200 000 FCFA/an/pers (voir observation)</td>"),
      array("<td>90%</td>","<td>20 000 F CFA/Jr</td>","<td>90%</td>","<td>25 000 F CFA/Jr</td>","<td>90%</td>","<td>30 000 FCFA/jr</td>"),
      array("<td>90%</td>","<td rowspan='5'>150 000 FCFA par hospitalisation dans la limite de deux(2) hospitalisations par an</td>","<td>90%</td>","<td rowspan='5'>300 000 FCFA par hospitalisation dans la limite de deux(2) hospitalisations par an</td>","<td>90%</td>","<td rowspan='5'>500 000 FCFA par hospitalisation dans la limite de deux (2) hospitalisation par an</td>"),
      array("<td>90%</td>","<td>100000</td>","<td>90%</td>","<td>200000</td>","<td>90%</td>","<td>400000</td>"),
      array("<td>90%</td>","<td>150000</td>","<td>90%</td>","<td>250000</td>","<td>90%</td>","<td>300000</td>"),
      array("<td>90%</td>","<td>200000</td>","<td>90%</td>","<td>300000</td>","<td>90%</td>","<td>350000</td>"),
      array("<td>90%</td>","<td>300000</td>","<td>90%</td>","<td>350000</td>","<td>90%</td>","<td>400000</td>"),
      array("<td>90%</td>","<td>50000</td>","<td>90%</td>","<td>60000</td>","<td>90%</td>","<td>75000</td>"),      
      array("<td>90%</td>","<td>60 000 tous les 2 ans calendaire</td>","<td>90%</td>","<td>60 000 tous les 2 ans calendaire</td>","<td>90%</td>","<td>100 000 tous les 2 ans calendaire</td>"),
      array("<td></td>","<td>exclus</td>","<td></td>","<td>exclus</td>","<td></td>","<td>exclus</td>"),
      array("<td>90%</td>","<td>20000</td>","<td>90%</td>","<td>25000</td>","<td>90%</td>","<td>30000</td>"),
      array("<td  colspan='2'>1 000 000 FCFA</td>","<td  colspan='2'>2 000 000 FCFA</td>","<td  colspan='2'>4 000 000 FCFA</td>"),
      array("<td  colspan='2'>2 500 000 FCFA</td>","<td  colspan='2'>5 000 000 FCFA</td>","<td  colspan='2'>10 000 000 FCFA</td>"),
    );
  }
  elseif ($cat1=='FANGAN (80%)') {
    # code...
    $plafonds= array(
      array("<td>80%</td>","<td>150000</td>","<td>80%</td>","<td>300000</td>","<td>80%</td>","<td>Frais réels</td>"),
      array("<td>80%</td>","<td>150000</td>","<td>80%</td>","<td>300000</td>","<td>80%</td>","<td>Frais réels</td>"),
      array("<td>80%</td>","<td>150000</td>","<td>80%</td>","<td>300000</td>","<td>80%</td>","<td>Frais réels</td>"),
      array("<td>80%</td>","<td>150000</td>","<td>80%</td>","<td>300000</td>","<td>80%</td>","<td>Frais réels</td>"),
      array("<td>80%</td>","<td>150000</td>","<td>80%</td>","<td>300000</td>","<td>80%</td>","<td>Frais réels</td>"),
      array("<td>80%</td>","<td>150000</td>","<td>80%</td>","<td>300000</td>","<td>80%</td>","<td>Frais réels</td>"),
      array("<td>80%</td>","<td>50000</td>","<td>80%</td>","<td>50000</td>","<td>80%</td>","<td>Frais réels Tarif INHP</td>"),
      array("<td>80%</td>","<td>50000</td>","<td>80%</td>","<td>50000</td>","<td>80%</td>","<td>500 000 frs /personne /an</td>"),
      array("<td>80%</td>","<td>50000</td>","<td>80%</td>","<td>50000</td>","<td>80%</td>","<td>frais réels </td>"),
      array("<td></td>","<td>150000</td>","<td></td>","<td></td>","<td></td>","<td></td>"),
      array("<td>80%</td>","<td>80000</td>","<td>80%</td>","<td>160000</td>","<td>80%</td>","<td>250 000 FCFA/an/pers (voir observation)</td>"),
      array("<td>80%</td>","<td>80000</td>","<td>80%</td>","<td>160000</td>","<td>80%</td>","<td>200 000 FCFA/an/pers (voir observation)</td>"),
      array("<td>80%</td>","<td>20 000 F CFA/Jr</td>","<td>80%</td>","<td>25 000 F CFA/Jr</td>","<td>80%</td>","<td>30 000 FCFA/jr</td>"),
      array("<td>80%</td>","<td rowspan='5'>150 000 FCFA par hospitalisation dans la limite de deux(2) hospitalisations par an</td>","<td>80%</td>","<td rowspan='5'>300 000 FCFA par hospitalisation dans la limite de deux(2) hospitalisations par an</td>","<td>80%</td>","<td rowspan='5'>500 000 FCFA par hospitalisation dans la limite de deux (2) hospitalisation par an</td>"),
      array("<td>80%</td>","<td>100000</td>","<td>80%</td>","<td>200000</td>","<td>80%</td>","<td>400000</td>"),
      array("<td>80%</td>","<td>150000</td>","<td>80%</td>","<td>250000</td>","<td>80%</td>","<td>300000</td>"),
      array("<td>80%</td>","<td>200000</td>","<td>80%</td>","<td>300000</td>","<td>80%</td>","<td>350000</td>"),
      array("<td>80%</td>","<td>300000</td>","<td>80%</td>","<td>350000</td>","<td>80%</td>","<td>400000</td>"),
      array("<td>80%</td>","<td>50000</td>","<td>80%</td>","<td>60000</td>","<td>80%</td>","<td>75000</td>"),
      array("<td>80%</td>","<td>60 000 tous les 2 ans calendaire</td>","<td>80%</td>","<td>60 000 tous les 2 ans calendaire</td>","<td>80%</td>","<td>100 000 tous les 2 ans calendaire</td>"),
      array("<td></td>","<td>exclus</td>","<td></td>","<td>exclus</td>","<td></td>","<td>exclus</td>"),
      array("<td>80%</td>","<td>20000</td>","<td>80%</td>","<td>25000</td>","<td>80%</td>","<td>30000</td>"),
      array("<td  colspan='2'>1 000 000 FCFA</td>","<td  colspan='2'>2 000 000 FCFA</td>","<td  colspan='2'>4 000 000 FCFA</td>"),
      array("<td  colspan='2'>2 500 000 FCFA</td>","<td  colspan='2'>5 000 000 FCFA</td>","<td  colspan='2'>10 000 000 FCFA</td>"),
    );
  }
  elseif ($cat1=='TCHERNIME (70%)') {
    # code...
    $plafonds= array(
      array("<td>70%</td>","<td>150000</td>","<td>70%</td>","<td>300000</td>","<td>70%</td>","<td>Frais réels</td>"),
      array("<td>70%</td>","<td>150000</td>","<td>70%</td>","<td>300000</td>","<td>70%</td>","<td>Frais réels</td>"),
      array("<td>70%</td>","<td>150000</td>","<td>70%</td>","<td>300000</td>","<td>70%</td>","<td>Frais réels</td>"),
      array("<td>70%</td>","<td>150000</td>","<td>70%</td>","<td>300000</td>","<td>70%</td>","<td>Frais réels</td>"),
      array("<td>70%</td>","<td>150000</td>","<td>70%</td>","<td>300000</td>","<td>70%</td>","<td>Frais réels</td>"),
      array("<td>70%</td>","<td>150000</td>","<td>70%</td>","<td>300000</td>","<td>70%</td>","<td>Frais réels</td>"),
      array("<td>70%</td>","<td>50000</td>","<td>70%</td>","<td>50000</td>","<td>70%</td>","<td>Frais réels Tarif INHP</td>"),
      array("<td>70%</td>","<td>50000</td>","<td>70%</td>","<td>50000</td>","<td>70%</td>","<td>500 000 frs /personne /an</td>"),
      array("<td>70%</td>","<td>50000</td>","<td>70%</td>","<td>50000</td>","<td>70%</td>","<td>frais réels </td>"),
      array("<td></td>","<td>150000</td>","<td></td>","<td></td>","<td></td>","<td></td>"),
      array("<td>70%</td>","<td>80000</td>","<td>70%</td>","<td>160000</td>","<td>70%</td>","<td>250 000 FCFA/an/pers(voir observation)</td>"),
      array("<td>70%</td>","<td>80000</td>","<td>70%</td>","<td>160000</td>","<td>70%</td>","<td>200 000 FCFA/an/pers(voir observation)</td>"),
      array("<td>70%</td>","<td>20 000 F CFA/Jr</td>","<td>70%</td>","<td>25 000 F CFA/Jr</td>","<td>70%</td>","<td>30 000 FCFA/jr</td>"),
      array("<td>70%</td>","<td rowspan='5'>150 000 FCFA par hospitalisation dans la limite de deux(2) hospitalisations par an</td>","<td>70%</td>","<td rowspan='5'>300 000 FCFA par hospitalisation dans la limite de deux(2) hospitalisations par an</td>","<td>70%</td>","<td rowspan='5'>500 000 FCFA par hospitalisation dans la limite de deux (2) hospitalisation par an </td>"),
      array("<td>70%</td>","<td>100000</td>","<td>70%</td>","<td>200000</td>","<td>70%</td>","<td>400000</td>"),
      array("<td>70%</td>","<td>150000</td>","<td>70%</td>","<td>250000</td>","<td>70%</td>","<td>300000</td>"),
      array("<td>70%</td>","<td>200000</td>","<td>70%</td>","<td>300000</td>","<td>70%</td>","<td>350000</td>"),
      array("<td>70%</td>","<td>300000</td>","<td>70%</td>","<td>350000</td>","<td>70%</td>","<td>400000</td>"),
      array("<td>70%</td>","<td>50000</td>","<td>70%</td>","<td>60000</td>","<td>70%</td>","<td>75000</td>"),
      array("<td>70%</td>","<td>60 000 tous les 2 ans calendaire</td>","<td>70%</td>","<td>60 000 tous les 2 ans calendaire</td>","<td>70%</td>","<td>100 000 tous les 2 ans calendaire</td>"),
      array("<td></td>","<td>exclus</td>","<td></td>","<td>exclus</td>","<td></td>","<td>exclus</td>"),
      array("<td>70%</td>","<td>20000</td>","<td>70%</td>","<td>25000</td>","<td>70%</td>","<td>30000</td>"),
      array("<td  colspan='2'>1 000 000 FCFA</td>","<td  colspan='2'>2 000 000 FCFA</td>","<td  colspan='2'>4 000 000 FCFA</td>"),
      array("<td  colspan='2'>2 500 000 FCFA</td>","<td  colspan='2'>5 000 000 FCFA</td>","<td  colspan='2'>10 000 000 FCFA</td>"),
    );
  }
  elseif ($cat1=='KOUMETAI (60%)') {
    # code...
    $plafonds= array(
      array("<td>60%</td>","<td>150000</td>","<td>60%</td>","<td>300000</td>","<td>60%</td>","<td> Frais réels </td>"),
      array("<td>60%</td>","<td>150000</td>","<td>60%</td>","<td>300000</td>","<td>60%</td>","<td> Frais réels </td>"),
      array("<td>60%</td>","<td>150000</td>","<td>60%</td>","<td>300000</td>","<td>60%</td>","<td> Frais réels </td>"),
      array("<td>60%</td>","<td>150000</td>","<td>60%</td>","<td>300000</td>","<td>60%</td>","<td> Frais réels </td>"),
      array("<td>60%</td>","<td>150000</td>","<td>60%</td>","<td>300000</td>","<td>60%</td>","<td> Frais réels </td>"),
      array("<td>60%</td>","<td>150000</td>","<td>60%</td>","<td>300000</td>","<td>60%</td>","<td> Frais réels </td>"),
      array("<td>60%</td>","<td>50000</td>","<td>60%</td>","<td>50000</td>","<td>60%</td>","<td> Frais réels Tarif INHP </td>"),
      array("<td>60%</td>","<td>50000</td>","<td>60%</td>","<td>50000</td>","<td>60%</td>","<td> 500 000 frs /personne /an </td>"),
      array("<td>60%</td>","<td>50000</td>","<td>60%</td>","<td>50000</td>","<td>60%</td>","<td> frais réels  </td>"),
      array("<td></td>","<td>150000</td>","<td></td>","<td></td>","<td></td>","<td></td>"),
      array("<td>60%</td>","<td>80000</td>","<td>60%</td>","<td>160000</td>","<td>60%</td>","<td> 250 000 FCFA/an/pers (voir observation) </td>"),
      array("<td>60%</td>","<td>80000</td>","<td>60%</td>","<td>160000</td>","<td>60%</td>","<td> 200 000 FCFA/an/pers (voir observation) </td>"),
      array("<td>60%</td>","<td>20 000 F CFA/Jr</td>","<td>60%</td>","<td>25 000 F CFA/Jr</td>","<td>60%</td>","<td> 30 000 FCFA/jr </td>"),
      array("<td>60%</td>","<td rowspan='5'> 150 000 FCFA par hospitalisation dans la limite de deux(2) hospitalisations par an </td>","<td>60%</td>","<td rowspan='5'> 300 000 FCFA par hospitalisation dans la limite de deux(2) hospitalisations par an </td>","<td>60%</td>","<td rowspan='5'> 500 000 FCFA par hospitalisation dans la limite de deux (2) hospitalisation par an</td>"),
      array("<td>60%</td>","<td>100000</td>","<td>60%</td>","<td>200000</td>","<td>60%</td>","<td>400000</td>"),
      array("<td>60%</td>","<td>150000</td>","<td>60%</td>","<td>250000</td>","<td>60%</td>","<td>300000</td>"),
      array("<td>60%</td>","<td>200000</td>","<td>60%</td>","<td>300000</td>","<td>60%</td>","<td>350000</td>"),
      array("<td>60%</td>","<td>300000</td>","<td>60%</td>","<td>350000</td>","<td>60%</td>","<td>400000</td>"),
      array("<td>60%</td>","<td>50000</td>","<td>60%</td>","<td>60000</td>","<td>60%</td>","<td>75000</td>"),      
      array("<td>60%</td>","<td> 60 000 tous les 2 ans calendaire </td>","<td>60%</td>","<td> 60 000 tous les 2 ans calendaire </td>","<td>60%</td>","<td> 100 000 tous les 2 ans calendaire </td>"),
      array("<td></td>","<td> exclus </td>","<td></td>","<td> exclus </td>","<td></td>","<td> exclus </td>"),
      array("<td>60%</td>","<td>20000</td>","<td>60%</td>","<td>25000</td>","<td>60%</td>","<td>30000</td>"),
      array("<td  colspan='2'>1 000 000 FCFA</td>","<td  colspan='2'>2 000 000 FCFA</td>","<td  colspan='2'>4 000 000 FCFA</td>"),
      array("<td  colspan='2'>2 500 000 FCFA</td>","<td  colspan='2'>5 000 000 FCFA</td>","<td  colspan='2'>10 000 000 FCFA</td>"),
    );
  }
  echo "
      <table class='bareme'>
              <thead>
              <tr>
                <th>".$cat1."</th>
                <th colspan='2' class='prod_cat'>".$cat2."</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td  class='prod_titre'>Soins Ambulatoires et Hospitaliers</td>
                <td  class='prod_titre'>Taux de remboursement</td>
                <td  class='prod_titre'>Plafonds</td>      
              </tr>
              <tr>
                <td  colspan='7' class='defwidth prod_titre'>CONSULTATION / DIVERS</td>
              </tr>
              <tr>
                <td >Consultation Généraliste</td>
                ".$plafonds[0][$i].$plafonds[0][$j]."
              </tr>
              <tr>
                <td >Consultation Spécialiste</td>
                ".$plafonds[1][$i].$plafonds[1][$j]."
              </tr>
              <tr>
                <td >Consultation Urgence / Garde</td>
                ".$plafonds[2][$i].$plafonds[2][$j]."
              </tr>
              <tr>
                <td >Frais pharmaceutiques & Produits</td>
                ".$plafonds[3][$i].$plafonds[3][$j]."
              </tr>
              <tr>
                <td >Radiologie & Imagerie</td>
                ".$plafonds[4][$i].$plafonds[4][$j]."
              <tr>
                <td >Analyses Biologiques</td>
                ".$plafonds[5][$i].$plafonds[5][$j]."
              </tr>
              <tr>
                <td >Frais de traitements préventifs (vaccins) selon le tarif de l'INHP</td>
                ".$plafonds[6][$i].$plafonds[6][$j]."
              </tr>
              <tr>
                <td >Frais de traitement spécifiques anti reto viraux</td>
                ".$plafonds[7][$i].$plafonds[7][$j]."
              </tr>
              <tr>
                <td >Auxiliaires médicaux</td>
                ".$plafonds[8][$i].$plafonds[8][$j]."
              </tr>
              <tr>
                <td>DENTISTERIE Soins</td>
                ".$plafonds[9][$i].$plafonds[9][$j]."
              </tr>
              <tr>
                <td >Prothèses dentaires (y compris Orthodontie des enfants de moins 16 ans</td>
                ".$plafonds[10][$i].$plafonds[10][$j]."
              </tr>
              <tr>
                <td >Autres prothèses (orthopédique, auditive etc..)</td>
                ".$plafonds[11][$i].$plafonds[11][$j]."
              </tr>
              <tr>
                <td  colspan='7' class='defwidth prod_titre'>HOSPITALISATION</td>
              </tr>
              <tr>
                <td >Hébergement (y compris hébergement de la mère accompagnant un enfant de 7 ans)</td>
                ".$plafonds[12][$i].$plafonds[12][$j]."
              </tr>
              <tr>
                <td >Frais de traitement médicaux & chirurgicaux</td>
                ".$plafonds[13][$i].$plafonds[13][$j]."
              </tr>
              <tr>
                <td >Visite Généraliste</td>
                ".$plafonds[13][$i]."
              </tr>
              <tr>
                <td >Visite Spécialiste</td>
                ".$plafonds[13][$i]."
              </tr>
              <tr>
                <td >Petite Chirurgie / Soins</td>
                ".$plafonds[13][$i]."
              </tr>
              <tr>
                <td >AMI</td>
                ".$plafonds[13][$i]."
              </tr>
              <tr>
                <td  colspan='7' class='defwidth prod_titre'>MATERNITE</td>
              </tr>
              <tr>
                <td >Frais pré & post Natal</td>
                ".$plafonds[14][$i].$plafonds[14][$j]."
              </tr>
              <tr>
                <td >Accouchement simple</td>
                ".$plafonds[15][$i].$plafonds[15][$j]."
              </tr>
              <tr>
                <td >Accouchement Multiple</td>
                ".$plafonds[16][$i].$plafonds[16][$j]."
              </tr>
              <tr>
                <td >Accouchement Chirurgical</td>
                ".$plafonds[17][$i].$plafonds[17][$j]."
              </tr>
              <tr>
                <td >Versement forfaitaire sur présentation de l’extrait d’acte de naissance</td>
                ".$plafonds[18][$i].$plafonds[18][$j]."
              </tr>
              <tr>
                <td  colspan='7' class='defwidth prod_titre'>OPTIQUE</td>
              </tr>
              <tr>
                <td >Verres et Montures sans les commodités (antireflets,photogray,etc,)</td>
                ".$plafonds[19][$i].$plafonds[19][$j]."
              </tr>
              <tr>
                <td >Dioptries de + ou - 0,25 </td>
                ".$plafonds[20][$i].$plafonds[20][$j]."
              </tr>
              <tr>
                <td  colspan='7' class='defwidth prod_titre'>TRANSPORT</td>
              </tr>
              <tr>
                <td >Ambulance</td>
                ".$plafonds[21][$i].$plafonds[21][$j]."
              </tr>
              </tbody>
      </table>

      <table style=width:447px cellspacing=0 border=1>
            <tr>
              <td>OBSERVATIONS</td>
              <td style=width:239px>ENTENTE PREALABLE</td>
            </tr>
      </table>
      <table style=width:750px cellspacing=0 border=1>
            <tr>
              <td >Plafond</td>
              ".$plafonds[22][$k]."
            </tr>
            <tr>
              <td >Plafond Famille</td>                  
              ".$plafonds[23][$k]."
            </tr>
      </table></br>";
}
?>