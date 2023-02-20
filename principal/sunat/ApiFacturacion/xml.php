<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

class GeneradorXML {


    /**
     * ROMMEL MERCADO
     * @param type $nombrexml
     * @param type $emisor
     * @param type $cliente
     * @param type $comprobante
     * @param type $detalle
     */
    function CrearXMLFactura(
            $nombrexml,
            $emisor,
            $cliente,
            $comprobante,
            $detalle
    ) {

        $doc = new DOMDocument();
        $doc->formatOutput = FALSE;
        $doc->preserveWhiteSpace = TRUE;
        $doc->encoding = 'utf-8';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
      <Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2">
         <ext:UBLExtensions>
            <ext:UBLExtension>
               <ext:ExtensionContent />
            </ext:UBLExtension>
         </ext:UBLExtensions>
         <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
         <cbc:CustomizationID>2.0</cbc:CustomizationID>
         <cbc:ID>' . $comprobante['serie'] . '-' . $comprobante['correlativo'] . '</cbc:ID>
         <cbc:IssueDate>' . $comprobante['fecha_emision'] . '</cbc:IssueDate>
         <cbc:IssueTime>00:00:00</cbc:IssueTime>
         <cbc:DueDate>' . $comprobante['fecha_emision'] . '</cbc:DueDate>
         <cbc:InvoiceTypeCode listID="0101">' . $comprobante['tipodoc'] . '</cbc:InvoiceTypeCode>
         <cbc:Note languageLocaleID="1000"><![CDATA[' . $comprobante['total_texto'] . ']]></cbc:Note>
         <cbc:DocumentCurrencyCode>' . $comprobante['moneda'] . '</cbc:DocumentCurrencyCode>
         <cac:Signature>
            <cbc:ID>' . $emisor['ruc'] . '</cbc:ID>
            <cbc:Note><![CDATA[' . utf8_encode($emisor['nombre_comercial']) . ']]></cbc:Note>
            <cac:SignatoryParty>
               <cac:PartyIdentification>
                  <cbc:ID>' . $emisor['ruc'] . '</cbc:ID>
               </cac:PartyIdentification>
               <cac:PartyName>
                  <cbc:Name><![CDATA[' . utf8_encode($emisor['razon_social']) . ']]></cbc:Name>
               </cac:PartyName>
            </cac:SignatoryParty>
            <cac:DigitalSignatureAttachment>
               <cac:ExternalReference>
                  <cbc:URI>#SIGN-EMPRESAXXO</cbc:URI>
               </cac:ExternalReference>
            </cac:DigitalSignatureAttachment>
         </cac:Signature>
         <cac:AccountingSupplierParty>
            <cac:Party>
               <cac:PartyIdentification>
                  <cbc:ID schemeID="' . $emisor['tipodoc'] . '">' . $emisor['ruc'] . '</cbc:ID>
               </cac:PartyIdentification>
               <cac:PartyName>
                  <cbc:Name><![CDATA[' . utf8_encode($emisor['nombre_comercial']) . ']]></cbc:Name>
               </cac:PartyName>
               <cac:PartyLegalEntity>
                  <cbc:RegistrationName><![CDATA[' . utf8_encode($emisor['razon_social']) . ']]></cbc:RegistrationName>
                  <cac:RegistrationAddress>
                     <cbc:ID>' . $emisor['ubigeo'] . '</cbc:ID>
                     <cbc:AddressTypeCode>0000</cbc:AddressTypeCode>
                     <cbc:CitySubdivisionName>NONE</cbc:CitySubdivisionName>
                     <cbc:CityName>' . utf8_encode($emisor['provincia']) . '</cbc:CityName>
                     <cbc:CountrySubentity>' . utf8_encode($emisor['departamento']) . '</cbc:CountrySubentity>
                     <cbc:District>' . utf8_encode($emisor['distrito']) . '</cbc:District>
                     <cac:AddressLine>
                        <cbc:Line><![CDATA[' . utf8_encode($emisor['direccion']) . ']]></cbc:Line>
                     </cac:AddressLine>
                     <cac:Country>
                        <cbc:IdentificationCode>' . $emisor['pais'] . '</cbc:IdentificationCode>
                     </cac:Country>
                  </cac:RegistrationAddress>
               </cac:PartyLegalEntity>
            </cac:Party>
         </cac:AccountingSupplierParty>';

        if ($cliente['tipodoc'] == 6) {
            $xml .= '<cac:AccountingCustomerParty>
            <cac:Party>
               <cac:PartyIdentification>
                  <cbc:ID schemeID="' . $cliente['tipodoc'] . '">' . $cliente['ruc'] . '</cbc:ID>
               </cac:PartyIdentification>
               <cac:PartyLegalEntity>
                  <cbc:RegistrationName><![CDATA[' . utf8_encode($cliente['razon_social']) . ']]></cbc:RegistrationName>
                  <cac:RegistrationAddress>
                     <cac:AddressLine>
                        <cbc:Line><![CDATA[' . utf8_encode($cliente['direccion']) . ']]></cbc:Line>
                     </cac:AddressLine>
                     <cac:Country>
                        <cbc:IdentificationCode>' . $cliente['pais'] . '</cbc:IdentificationCode>
                     </cac:Country>
                  </cac:RegistrationAddress>
               </cac:PartyLegalEntity>
            </cac:Party>
         </cac:AccountingCustomerParty>';
        } else {
            $xml .= '<cac:AccountingCustomerParty>
            <cac:Party>
               <cac:PartyIdentification>
                  <cbc:ID schemeID="' . $cliente['tipodoc'] . '">' . $cliente['ruc'] . '</cbc:ID>
               </cac:PartyIdentification>
               <cac:PartyLegalEntity>
                  <cbc:RegistrationName><![CDATA[' . utf8_encode($cliente['razon_social']) . ']]></cbc:RegistrationName>
               </cac:PartyLegalEntity>
            </cac:Party>
         </cac:AccountingCustomerParty>';
        }

        if ($comprobante['formaPagoActivo'] == 1) {
            $xml .= '<cac:PaymentTerms>
                     <cbc:ID>FormaPago</cbc:ID>
                     <cbc:PaymentMeansID>Credito</cbc:PaymentMeansID>
                     <cbc:Amount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['total'] . '</cbc:Amount>
                  </cac:PaymentTerms>';
            for ($i = 1; $i <= $comprobante['numeroCuota']; $i++) {
                $nuevosDias = $comprobante['diasCuotasVentas'] * $i;
                $date1 = $comprobante['fecha_emision'];
                $fechaPago = date("Y-m-d", strtotime($date1 . "+ $nuevosDias days"));
                $xml .= '<cac:PaymentTerms>
                        <cbc:ID>FormaPago</cbc:ID>
                        <cbc:PaymentMeansID>Cuota00' . $i . '</cbc:PaymentMeansID>
                        <cbc:Amount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['formaPagoMontoApagarPorMes'] . '</cbc:Amount>
                        <cbc:PaymentDueDate >' . $fechaPago . '</cbc:PaymentDueDate>
                     </cac:PaymentTerms>';
            }
        } else {
            $xml .= '<cac:PaymentTerms>
         <cbc:ID>FormaPago</cbc:ID>
         <cbc:PaymentMeansID>Contado</cbc:PaymentMeansID>
      </cac:PaymentTerms>';
        }

        $xml .= '<cac:TaxTotal>
            <cbc:TaxAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['igv'] . '</cbc:TaxAmount>
            <cac:TaxSubtotal>
               <cbc:TaxableAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['total_opgravadas'] . '</cbc:TaxableAmount>
               <cbc:TaxAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['igv'] . '</cbc:TaxAmount>
               <cac:TaxCategory>
                  <cac:TaxScheme>
                     <cbc:ID>1000</cbc:ID>
                     <cbc:Name>IGV</cbc:Name>
                     <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                  </cac:TaxScheme>
               </cac:TaxCategory>
            </cac:TaxSubtotal>';

        //if ($comprobante['total_opexoneradas'] > 0) {
        if ($comprobante['total_opinafectas'] > 0) {
            $xml .= '<cac:TaxSubtotal>
                  <cbc:TaxableAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['total_opinafectas'] . '</cbc:TaxableAmount>
                  <cbc:TaxAmount currencyID="' . $comprobante['moneda'] . '">0.00</cbc:TaxAmount>
                  <cac:TaxCategory>
                     
                     <cac:TaxScheme>
                        <cbc:ID schemeName="Codigo de tributos" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo05">9998</cbc:ID>
                        <cbc:Name>INA</cbc:Name>
                        <cbc:TaxTypeCode>FRE</cbc:TaxTypeCode>
                     </cac:TaxScheme>
                  </cac:TaxCategory>
               </cac:TaxSubtotal>';
        }


        //==================================================================
        //ROMMEL MERCADO
        //18-12-2021
        //OPERACIONES GRATUITAS
        //==================================================================
        if ($comprobante['total_opgratuita'] > 0) {
            $xml .= '<cac:TaxSubtotal>
                        <cbc:TaxableAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['total_opgratuita'] . '</cbc:TaxableAmount>
                        <cbc:TaxAmount currencyID="' . $comprobante['moneda'] . '">0.00</cbc:TaxAmount>
                        <cac:TaxCategory>
                           <cac:TaxScheme>
                              <cbc:ID schemeName="Codigo de tributos" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo05">9996</cbc:ID>
                              <cbc:Name>GRA</cbc:Name>
                              <cbc:TaxTypeCode>FRE</cbc:TaxTypeCode>
                           </cac:TaxScheme>
                        </cac:TaxCategory>
                     </cac:TaxSubtotal>';
        }
        //==================================================================

        if ($comprobante['total_opexoneradas'] > 0) {
            // if ($comprobante['total_opinafectas'] > 0) {
            $xml .= '<cac:TaxSubtotal>
                  <cbc:TaxableAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['total_opinafectas'] . '</cbc:TaxableAmount>
                  <cbc:TaxAmount currencyID="' . $comprobante['moneda'] . '">0.00</cbc:TaxAmount>
                  <cac:TaxCategory>
                     <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">E</cbc:ID>
                     <cac:TaxScheme>
                        <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">9998</cbc:ID>
                        <cbc:Name>INA</cbc:Name>
                        <cbc:TaxTypeCode>FRE</cbc:TaxTypeCode>
                     </cac:TaxScheme>
                  </cac:TaxCategory>
               </cac:TaxSubtotal>';
        }

        $total_antes_de_impuestos = $comprobante['total_opgravadas'] + $comprobante['total_opexoneradas'] + $comprobante['total_opinafectas'];
        //$total_antes_de_impuestos = $comprobante['total_opgravadas'] + $comprobante['total_opexoneradas'];

        $xml .= '</cac:TaxTotal>
         <cac:LegalMonetaryTotal>
            <cbc:LineExtensionAmount currencyID="' . $comprobante['moneda'] . '">' . $total_antes_de_impuestos . '</cbc:LineExtensionAmount>
            <cbc:TaxInclusiveAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['total'] . '</cbc:TaxInclusiveAmount>
            <cbc:PayableAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['total'] . '</cbc:PayableAmount>
         </cac:LegalMonetaryTotal>';

        foreach ($detalle as $k => $v) {

            $xml .= '<cac:InvoiceLine>
               <cbc:ID>' . $v['item'] . '</cbc:ID>
               <cbc:InvoicedQuantity unitCode="' . $v['unidad'] . '">' . $v['cantidad'] . '</cbc:InvoicedQuantity>
               <cbc:LineExtensionAmount currencyID="' . $comprobante['moneda'] . '">' . $v['valor_total'] . '</cbc:LineExtensionAmount>
               <cac:PricingReference>
                  <cac:AlternativeConditionPrice>
                     <cbc:PriceAmount currencyID="' . $comprobante['moneda'] . '">' . $v['precio_unitario'] . '</cbc:PriceAmount>
                     <cbc:PriceTypeCode>' . $v['tipo_precio'] . '</cbc:PriceTypeCode>
                  </cac:AlternativeConditionPrice>
               </cac:PricingReference>
               <cac:TaxTotal>
                  <cbc:TaxAmount currencyID="' . $comprobante['moneda'] . '">' . $v['igv'] . '</cbc:TaxAmount>
                  <cac:TaxSubtotal>
                     <cbc:TaxableAmount currencyID="' . $comprobante['moneda'] . '">' . $v['valor_total'] . '</cbc:TaxableAmount>
                     <cbc:TaxAmount currencyID="' . $comprobante['moneda'] . '">' . $v['igv'] . '</cbc:TaxAmount>
                     <cac:TaxCategory>
                        <cbc:Percent>' . $v['porcentaje_igv'] . '</cbc:Percent>
                        <cbc:TaxExemptionReasonCode>' . $v['codigo_afectacion_alt'] . '</cbc:TaxExemptionReasonCode>
                        <cac:TaxScheme>
                           <cbc:ID>' . $v['codigo_afectacion'] . '</cbc:ID>
                           <cbc:Name>' . $v['nombre_afectacion'] . '</cbc:Name>
                           <cbc:TaxTypeCode>' . $v['tipo_afectacion'] . '</cbc:TaxTypeCode>
                        </cac:TaxScheme>
                     </cac:TaxCategory>
                  </cac:TaxSubtotal>
               </cac:TaxTotal>
               <cac:Item>
                  <cbc:Description><![CDATA[' . ($v['descripcion']) . ']]></cbc:Description>
                  <cac:SellersItemIdentification>
                     <cbc:ID>' . $v['codigo'] . '</cbc:ID>
                  </cac:SellersItemIdentification>
               </cac:Item>
               <cac:Price>
                  <cbc:PriceAmount currencyID="' . $comprobante['moneda'] . '">' . $v['valor_unitario'] . '</cbc:PriceAmount>
               </cac:Price>
            </cac:InvoiceLine>';
        }

        $xml .= "</Invoice>";
        //print_r($comprobante);
        $doc->loadXML($xml);
        $doc->save($nombrexml . '.XML');
    }

    /**
     * 
     * @param type $nombrexml
     * @param type $emisor
     * @param type $cliente
     * @param type $comprobante
     * @param type $detalle
     */
    function CrearXMLNotaCredito($nombrexml, $emisor, $cliente, $comprobante, $detalle) {
        $doc = new DOMDocument();
        $doc->formatOutput = FALSE;
        $doc->preserveWhiteSpace = TRUE;
        $doc->encoding = 'utf-8';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
      <CreditNote xmlns="urn:oasis:names:specification:ubl:schema:xsd:CreditNote-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2">
         <ext:UBLExtensions>
            <ext:UBLExtension>
               <ext:ExtensionContent />
            </ext:UBLExtension>
         </ext:UBLExtensions>
         <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
         <cbc:CustomizationID>2.0</cbc:CustomizationID>
         <cbc:ID>' . $comprobante['serie'] . '-' . $comprobante['correlativo'] . '</cbc:ID>
         <cbc:IssueDate>' . $comprobante['fecha_emision'] . '</cbc:IssueDate>
         <cbc:IssueTime>00:00:01</cbc:IssueTime>
         <cbc:Note languageLocaleID="1000"><![CDATA[' . $comprobante['total_texto'] . ']]></cbc:Note>
         <cbc:DocumentCurrencyCode>' . $comprobante['moneda'] . '</cbc:DocumentCurrencyCode>
         <cac:DiscrepancyResponse>
            <cbc:ReferenceID>' . $comprobante['serie_ref'] . '-' . $comprobante['correlativo_ref'] . '</cbc:ReferenceID>
            <cbc:ResponseCode>' . $comprobante['codmotivo'] . '</cbc:ResponseCode>
            <cbc:Description>' . utf8_encode($comprobante['descripcion']) . '</cbc:Description>
         </cac:DiscrepancyResponse>
         <cac:BillingReference>
            <cac:InvoiceDocumentReference>
               <cbc:ID>' . $comprobante['serie_ref'] . '-' . $comprobante['correlativo_ref'] . '</cbc:ID>
               <cbc:DocumentTypeCode>' . $comprobante['tipodoc_ref'] . '</cbc:DocumentTypeCode>
            </cac:InvoiceDocumentReference>
         </cac:BillingReference>
         <cac:Signature>
            <cbc:ID>' . $emisor['ruc'] . '</cbc:ID>
            <cbc:Note><![CDATA[' . utf8_encode($emisor['nombre_comercial']) . ']]></cbc:Note>
            <cac:SignatoryParty>
               <cac:PartyIdentification>
                  <cbc:ID>' . $emisor['ruc'] . '</cbc:ID>
               </cac:PartyIdentification>
               <cac:PartyName>
                  <cbc:Name><![CDATA[' . utf8_encode($emisor['razon_social']) . ']]></cbc:Name>
               </cac:PartyName>
            </cac:SignatoryParty>
            <cac:DigitalSignatureAttachment>
               <cac:ExternalReference>
                  <cbc:URI>#SIGN-EMPRESA</cbc:URI>
               </cac:ExternalReference>
            </cac:DigitalSignatureAttachment>
         </cac:Signature>
         <cac:AccountingSupplierParty>
            <cac:Party>
               <cac:PartyIdentification>
                  <cbc:ID schemeID="' . $emisor['tipodoc'] . '">' . $emisor['ruc'] . '</cbc:ID>
               </cac:PartyIdentification>
               <cac:PartyName>
                  <cbc:Name><![CDATA[' . utf8_encode($emisor['nombre_comercial']) . ']]></cbc:Name>
               </cac:PartyName>
               <cac:PartyLegalEntity>
                  <cbc:RegistrationName><![CDATA[' . utf8_encode($emisor['razon_social']) . ']]></cbc:RegistrationName>
                  <cac:RegistrationAddress>
                     <cbc:ID>' . $emisor['ubigeo'] . '</cbc:ID>
                     <cbc:AddressTypeCode>0000</cbc:AddressTypeCode>
                     <cbc:CitySubdivisionName>NONE</cbc:CitySubdivisionName>
                     <cbc:CityName>' . utf8_encode($emisor['provincia']) . '</cbc:CityName>
                     <cbc:CountrySubentity>' . utf8_encode($emisor['departamento']) . '</cbc:CountrySubentity>
                     <cbc:District>' . utf8_encode($emisor['distrito']) . '</cbc:District>
                     <cac:AddressLine>
                        <cbc:Line><![CDATA[' . utf8_encode($emisor['direccion']) . ']]></cbc:Line>
                     </cac:AddressLine>
                     <cac:Country>
                        <cbc:IdentificationCode>' . $emisor['pais'] . '</cbc:IdentificationCode>
                     </cac:Country>
                  </cac:RegistrationAddress>
               </cac:PartyLegalEntity>
            </cac:Party>
         </cac:AccountingSupplierParty>';
        if ($cliente['tipodoc'] == 6) {
            $xml .= '<cac:AccountingCustomerParty>
               <cac:Party>
                  <cac:PartyIdentification>
                     <cbc:ID schemeID="' . $cliente['tipodoc'] . '">' . $cliente['ruc'] . '</cbc:ID>
                  </cac:PartyIdentification>
                  <cac:PartyLegalEntity>
                     <cbc:RegistrationName><![CDATA[' . utf8_encode($cliente['razon_social']) . ']]></cbc:RegistrationName>
                     <cac:RegistrationAddress>
                        <cac:AddressLine>
                           <cbc:Line><![CDATA[' . utf8_encode($cliente['direccion']) . ']]></cbc:Line>
                        </cac:AddressLine>
                        <cac:Country>
                           <cbc:IdentificationCode>' . $cliente['pais'] . '</cbc:IdentificationCode>
                        </cac:Country>
                     </cac:RegistrationAddress>
                  </cac:PartyLegalEntity>
               </cac:Party>
            </cac:AccountingCustomerParty>';
        } else {
            $xml .= '<cac:AccountingCustomerParty>
               <cac:Party>
                  <cac:PartyIdentification>
                     <cbc:ID schemeID="' . $cliente['tipodoc'] . '">' . $cliente['ruc'] . '</cbc:ID>
                  </cac:PartyIdentification>
                  <cac:PartyLegalEntity>
                     <cbc:RegistrationName><![CDATA[' . utf8_encode($cliente['razon_social']) . ']]></cbc:RegistrationName>
                  </cac:PartyLegalEntity>
               </cac:Party>
            </cac:AccountingCustomerParty>';
        }

        $xml .= '<cac:TaxTotal>
            <cbc:TaxAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['igv'] . '</cbc:TaxAmount>
            <cac:TaxSubtotal>
               <cbc:TaxableAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['total_opgravadas'] . '</cbc:TaxableAmount>
               <cbc:TaxAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['igv'] . '</cbc:TaxAmount>
               <cac:TaxCategory>
                  <cac:TaxScheme>
                     <cbc:ID>1000</cbc:ID>
                     <cbc:Name>IGV</cbc:Name>
                     <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                  </cac:TaxScheme>
               </cac:TaxCategory>
            </cac:TaxSubtotal>';

        if ($comprobante['total_opexoneradas'] > 0) {
            $xml .= '<cac:TaxSubtotal>
                  <cbc:TaxableAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['total_opexoneradas'] . '</cbc:TaxableAmount>
                  <cbc:TaxAmount currencyID="' . $comprobante['moneda'] . '">0.00</cbc:TaxAmount>
                  <cac:TaxCategory>
                     <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">E</cbc:ID>
                     <cac:TaxScheme>
                        <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">9997</cbc:ID>
                        <cbc:Name>EXO</cbc:Name>
                        <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                     </cac:TaxScheme>
                  </cac:TaxCategory>
               </cac:TaxSubtotal>';
        }

        if ($comprobante['total_opinafectas'] > 0) {
            $xml .= '<cac:TaxSubtotal>
                  <cbc:TaxableAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['total_opinafectas'] . '</cbc:TaxableAmount>
                  <cbc:TaxAmount currencyID="' . $comprobante['moneda'] . '">0.00</cbc:TaxAmount>
                  <cac:TaxCategory>
                     <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">E</cbc:ID>
                     <cac:TaxScheme>
                        <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">9998</cbc:ID>
                        <cbc:Name>INA</cbc:Name>
                        <cbc:TaxTypeCode>FRE</cbc:TaxTypeCode>
                     </cac:TaxScheme>
                  </cac:TaxCategory>
               </cac:TaxSubtotal>';
        }

        $xml .= '</cac:TaxTotal>
         <cac:LegalMonetaryTotal>
            <cbc:PayableAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['total'] . '</cbc:PayableAmount>
         </cac:LegalMonetaryTotal>';

        foreach ($detalle as $k => $v) {

            $xml .= '<cac:CreditNoteLine>
               <cbc:ID>' . $v['item'] . '</cbc:ID>
               <cbc:CreditedQuantity unitCode="' . $v['unidad'] . '">' . $v['cantidad'] . '</cbc:CreditedQuantity>
               <cbc:LineExtensionAmount currencyID="' . $comprobante['moneda'] . '">' . $v['valor_total'] . '</cbc:LineExtensionAmount>
               <cac:PricingReference>
                  <cac:AlternativeConditionPrice>
                     <cbc:PriceAmount currencyID="' . $comprobante['moneda'] . '">' . $v['precio_unitario'] . '</cbc:PriceAmount>
                     <cbc:PriceTypeCode>' . $v['tipo_precio'] . '</cbc:PriceTypeCode>
                  </cac:AlternativeConditionPrice>
               </cac:PricingReference>
               <cac:TaxTotal>
                  <cbc:TaxAmount currencyID="' . $comprobante['moneda'] . '">' . $v['igv'] . '</cbc:TaxAmount>
                  <cac:TaxSubtotal>
                     <cbc:TaxableAmount currencyID="' . $comprobante['moneda'] . '">' . $v['valor_total'] . '</cbc:TaxableAmount>
                     <cbc:TaxAmount currencyID="' . $comprobante['moneda'] . '">' . $v['igv'] . '</cbc:TaxAmount>
                     <cac:TaxCategory>
                        <cbc:Percent>' . $v['porcentaje_igv'] . '</cbc:Percent>
                        <cbc:TaxExemptionReasonCode>' . $v['codigo_afectacion_alt'] . '</cbc:TaxExemptionReasonCode>
                        <cac:TaxScheme>
                           <cbc:ID>' . $v['codigo_afectacion'] . '</cbc:ID>
                           <cbc:Name>' . $v['nombre_afectacion'] . '</cbc:Name>
                           <cbc:TaxTypeCode>' . $v['tipo_afectacion'] . '</cbc:TaxTypeCode>
                        </cac:TaxScheme>
                     </cac:TaxCategory>
                  </cac:TaxSubtotal>
               </cac:TaxTotal>
               <cac:Item>
                  <cbc:Description><![CDATA[' . utf8_encode($v['descripcion']) . ']]></cbc:Description>
                  <cac:SellersItemIdentification>
                     <cbc:ID>' . $v['codigo'] . '</cbc:ID>
                  </cac:SellersItemIdentification>
               </cac:Item>
               <cac:Price>
                  <cbc:PriceAmount currencyID="' . $comprobante['moneda'] . '">' . $v['valor_unitario'] . '</cbc:PriceAmount>
               </cac:Price>
            </cac:CreditNoteLine>';
        }
        $xml .= '</CreditNote>';

        $doc->loadXML($xml);
        $doc->save($nombrexml . '.XML');
    }

    /**
     * 
     * @param type $nombrexml
     * @param type $emisor
     * @param type $cliente
     * @param type $comprobante
     * @param type $detalle
     */
    function CrearXMLNotaDebito($nombrexml, $emisor, $cliente, $comprobante, $detalle) {

        $doc = new DOMDocument();
        $doc->formatOutput = FALSE;
        $doc->preserveWhiteSpace = TRUE;
        $doc->encoding = 'utf-8';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
      <DebitNote xmlns="urn:oasis:names:specification:ubl:schema:xsd:DebitNote-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2">
         <ext:UBLExtensions>
            <ext:UBLExtension>
               <ext:ExtensionContent />
            </ext:UBLExtension>
         </ext:UBLExtensions>
         <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
         <cbc:CustomizationID>2.0</cbc:CustomizationID>
         <cbc:ID>' . $comprobante['serie'] . '-' . $comprobante['correlativo'] . '</cbc:ID>
         <cbc:IssueDate>' . $comprobante['fecha_emision'] . '</cbc:IssueDate>
         <cbc:IssueTime>00:00:03</cbc:IssueTime>
         <cbc:Note languageLocaleID="1000"><![CDATA[' . $comprobante['total_texto'] . ']]></cbc:Note>
         <cbc:DocumentCurrencyCode>' . $comprobante['moneda'] . '</cbc:DocumentCurrencyCode>
         <cac:DiscrepancyResponse>
            <cbc:ReferenceID>' . $comprobante['serie_ref'] . '-' . $comprobante['correlativo_ref'] . '</cbc:ReferenceID>
            <cbc:ResponseCode>' . $comprobante['codmotivo'] . '</cbc:ResponseCode>
            <cbc:Description>' . $comprobante['descripcion'] . '</cbc:Description>
         </cac:DiscrepancyResponse>
         <cac:BillingReference>
            <cac:InvoiceDocumentReference>
               <cbc:ID>' . $comprobante['serie_ref'] . '-' . $comprobante['correlativo_ref'] . '</cbc:ID>
               <cbc:DocumentTypeCode>' . $comprobante['tipodoc_ref'] . '</cbc:DocumentTypeCode>
            </cac:InvoiceDocumentReference>
         </cac:BillingReference>
         <cac:Signature>
            <cbc:ID>' . $emisor['ruc'] . '</cbc:ID>
            <cbc:Note><![CDATA[' . utf8_encode($emisor['nombre_comercial']) . ']]></cbc:Note>
            <cac:SignatoryParty>
               <cac:PartyIdentification>
                  <cbc:ID>' . $emisor['ruc'] . '</cbc:ID>
               </cac:PartyIdentification>
               <cac:PartyName>
                  <cbc:Name><![CDATA[' . utf8_encode($emisor['razon_social']) . ']]></cbc:Name>
               </cac:PartyName>
            </cac:SignatoryParty>
            <cac:DigitalSignatureAttachment>
               <cac:ExternalReference>
                  <cbc:URI>#SIGN-EMPRESA</cbc:URI>
               </cac:ExternalReference>
            </cac:DigitalSignatureAttachment>
         </cac:Signature>
         <cac:AccountingSupplierParty>
            <cac:Party>
               <cac:PartyIdentification>
                  <cbc:ID schemeID="' . $emisor['tipodoc'] . '">' . $emisor['ruc'] . '</cbc:ID>
               </cac:PartyIdentification>
               <cac:PartyName>
                  <cbc:Name><![CDATA[' . utf8_encode($emisor['nombre_comercial']) . ']]></cbc:Name>
               </cac:PartyName>
               <cac:PartyLegalEntity>
                  <cbc:RegistrationName><![CDATA[' . utf8_encode($emisor['razon_social']) . ']]></cbc:RegistrationName>
                  <cac:RegistrationAddress>
                     <cbc:ID>' . $emisor['ubigeo'] . '</cbc:ID>
                     <cbc:AddressTypeCode>0000</cbc:AddressTypeCode>
                     <cbc:CitySubdivisionName>NONE</cbc:CitySubdivisionName>
                     <cbc:CityName>' . utf8_encode($emisor['provincia']) . '</cbc:CityName>
                     <cbc:CountrySubentity>' . utf8_encode($emisor['departamento']) . '</cbc:CountrySubentity>
                     <cbc:District>' . utf8_encode($emisor['distrito']) . '</cbc:District>
                     <cac:AddressLine>
                        <cbc:Line><![CDATA[' . utf8_encode($emisor['direccion']) . ']]></cbc:Line>
                     </cac:AddressLine>
                     <cac:Country>
                        <cbc:IdentificationCode>' . $emisor['pais'] . '</cbc:IdentificationCode>
                     </cac:Country>
                  </cac:RegistrationAddress>
               </cac:PartyLegalEntity>
            </cac:Party>
         </cac:AccountingSupplierParty>
            <cac:AccountingCustomerParty>
            <cac:Party>
               <cac:PartyIdentification>
                  <cbc:ID schemeID="' . $cliente['tipodoc'] . '">' . $cliente['ruc'] . '</cbc:ID>
               </cac:PartyIdentification>
               <cac:PartyLegalEntity>
                  <cbc:RegistrationName><![CDATA[' . utf8_encode($cliente['razon_social']) . ']]></cbc:RegistrationName>
                  <cac:RegistrationAddress>
                     <cac:AddressLine>
                        <cbc:Line><![CDATA[' . utf8_encode($cliente['direccion']) . ']]></cbc:Line>
                     </cac:AddressLine>
                     <cac:Country>
                        <cbc:IdentificationCode>' . $cliente['pais'] . '</cbc:IdentificationCode>
                     </cac:Country>
                  </cac:RegistrationAddress>
               </cac:PartyLegalEntity>
            </cac:Party>
         </cac:AccountingCustomerParty>
         <cac:TaxTotal>
            <cbc:TaxAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['igv'] . '</cbc:TaxAmount>
            <cac:TaxSubtotal>
               <cbc:TaxableAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['total_opgravadas'] . '</cbc:TaxableAmount>
               <cbc:TaxAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['igv'] . '</cbc:TaxAmount>
               <cac:TaxCategory>
                  <cac:TaxScheme>
                     <cbc:ID>1000</cbc:ID>
                     <cbc:Name>IGV</cbc:Name>
                     <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                  </cac:TaxScheme>
               </cac:TaxCategory>
            </cac:TaxSubtotal>
         </cac:TaxTotal>
         <cac:RequestedMonetaryTotal>
            <cbc:PayableAmount currencyID="' . $comprobante['moneda'] . '">' . $comprobante['total'] . '</cbc:PayableAmount>
         </cac:RequestedMonetaryTotal>';

        foreach ($detalle as $k => $v) {

            $xml .= '<cac:DebitNoteLine>
               <cbc:ID>' . $v['item'] . '</cbc:ID>
               <cbc:DebitedQuantity unitCode="' . $v['unidad'] . '">' . $v['cantidad'] . '</cbc:DebitedQuantity>
               <cbc:LineExtensionAmount currencyID="' . $comprobante['moneda'] . '">' . $v['valor_total'] . '</cbc:LineExtensionAmount>
               <cac:PricingReference>
                  <cac:AlternativeConditionPrice>
                     <cbc:PriceAmount currencyID="' . $comprobante['moneda'] . '">' . $v['precio_unitario'] . '</cbc:PriceAmount>
                     <cbc:PriceTypeCode>' . $v['tipo_precio'] . '</cbc:PriceTypeCode>
                  </cac:AlternativeConditionPrice>
               </cac:PricingReference>
               <cac:TaxTotal>
                  <cbc:TaxAmount currencyID="' . $comprobante['moneda'] . '">' . $v['igv'] . '</cbc:TaxAmount>
                  <cac:TaxSubtotal>
                     <cbc:TaxableAmount currencyID="' . $comprobante['moneda'] . '">' . $v['valor_total'] . '</cbc:TaxableAmount>
                     <cbc:TaxAmount currencyID="' . $comprobante['moneda'] . '">' . $v['igv'] . '</cbc:TaxAmount>
                     <cac:TaxCategory>
                        <cbc:Percent>' . $v['porcentaje_igv'] . '</cbc:Percent>
                        <cbc:TaxExemptionReasonCode>10</cbc:TaxExemptionReasonCode>
                        <cac:TaxScheme>
                           <cbc:ID>' . $v['codigo_afectacion'] . '</cbc:ID>
                           <cbc:Name>' . $v['nombre_afectacion'] . '</cbc:Name>
                           <cbc:TaxTypeCode>' . $v['tipo_afectacion'] . '</cbc:TaxTypeCode>
                        </cac:TaxScheme>
                     </cac:TaxCategory>
                  </cac:TaxSubtotal>
               </cac:TaxTotal>
               <cac:Item>
                  <cbc:Description><![CDATA[' . utf8_encode($v['descripcion']) . ']]></cbc:Description>
                  <cac:SellersItemIdentification>
                     <cbc:ID>' . $v['codigo'] . '</cbc:ID>
                  </cac:SellersItemIdentification>
               </cac:Item>
               <cac:Price>
                  <cbc:PriceAmount currencyID="' . $comprobante['moneda'] . '">' . $v['valor_unitario'] . '</cbc:PriceAmount>
               </cac:Price>
            </cac:DebitNoteLine>';
        }

        $xml .= '</DebitNote>';

        $doc->loadXML($xml);
        $doc->save($nombrexml . '.XML');
    }

    /**
     * 
     * @param type $emisor
     * @param type $cabecera
     * @param type $detalle
     * @param type $nombrexml
     */
    function CrearXMLResumenDocumentos($emisor, $cabecera, $detalle, $nombrexml) {
        $doc = new DOMDocument();
        $doc->formatOutput = FALSE;
        $doc->preserveWhiteSpace = TRUE;
        $doc->encoding = 'utf-8';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
           <SummaryDocuments xmlns="urn:sunat:names:specification:ubl:peru:schema:xsd:SummaryDocuments-1" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:sac="urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2">
          <ext:UBLExtensions>
              <ext:UBLExtension>
                  <ext:ExtensionContent />
              </ext:UBLExtension>
          </ext:UBLExtensions>
          <cbc:UBLVersionID>2.0</cbc:UBLVersionID>
          <cbc:CustomizationID>1.1</cbc:CustomizationID>
          <cbc:ID>' . $cabecera['tipodoc'] . '-' . $cabecera['serie'] . '-' . $cabecera['correlativo'] . '</cbc:ID>
          <cbc:ReferenceDate>' . $cabecera['fecha_emision'] . '</cbc:ReferenceDate>
          <cbc:IssueDate>' . $cabecera['fecha_envio'] . '</cbc:IssueDate>
          <cac:Signature>
              <cbc:ID>' . $cabecera['tipodoc'] . '-' . $cabecera['serie'] . '-' . $cabecera['correlativo'] . '</cbc:ID>
              <cac:SignatoryParty>
                  <cac:PartyIdentification>
                      <cbc:ID>' . $emisor['ruc'] . '</cbc:ID>
                  </cac:PartyIdentification>
                  <cac:PartyName>
                      <cbc:Name><![CDATA[' . utf8_encode($emisor['razon_social']) . ']]></cbc:Name>
                  </cac:PartyName>
              </cac:SignatoryParty>
              <cac:DigitalSignatureAttachment>
                  <cac:ExternalReference>
                      <cbc:URI>' . $cabecera['tipodoc'] . '-' . $cabecera['serie'] . '-' . $cabecera['correlativo'] . '</cbc:URI>
                  </cac:ExternalReference>
              </cac:DigitalSignatureAttachment>
          </cac:Signature>
          <cac:AccountingSupplierParty>
              <cbc:CustomerAssignedAccountID>' . $emisor['ruc'] . '</cbc:CustomerAssignedAccountID>
              <cbc:AdditionalAccountID>' . $emisor['tipodoc'] . '</cbc:AdditionalAccountID>
              <cac:Party>
                  <cac:PartyLegalEntity>
                      <cbc:RegistrationName><![CDATA[' . utf8_encode($emisor['razon_social']) . ']]></cbc:RegistrationName>
                  </cac:PartyLegalEntity>
              </cac:Party>
          </cac:AccountingSupplierParty>';

        foreach ($detalle as $k => $v) {
            $xml .= '<sac:SummaryDocumentsLine>
                 <cbc:LineID>' . $v['item'] . '</cbc:LineID>
                 <cbc:DocumentTypeCode>' . $v['tipodoc'] . '</cbc:DocumentTypeCode>
                 <cbc:ID>' . $v['serie'] . '-' . $v['correlativo'] . '</cbc:ID>';
             
              if (strlen($v['dnicli']) == 8) {
                  $xml .= '<cac:AccountingCustomerParty>
                          <cbc:CustomerAssignedAccountID>' . $v['dnicli'] . '</cbc:CustomerAssignedAccountID>
                          <cbc:AdditionalAccountID>1</cbc:AdditionalAccountID>
                          </cac:AccountingCustomerParty>';
              }
  
              $xml .= '<cac:Status>
                    <cbc:ConditionCode>' . $v['condicion'] . '</cbc:ConditionCode>
                 </cac:Status>                
                 <sac:TotalAmount currencyID="' . $v['moneda'] . '">' . $v['importe_total'] . '</sac:TotalAmount><sac:BillingPayment>
                           <cbc:PaidAmount currencyID="' . $v['moneda'] . '">' . $v['valor_total'] . '</cbc:PaidAmount>
                           <cbc:InstructionID>' . $v['tipo_total'] . '</cbc:InstructionID>
                       </sac:BillingPayment><cac:TaxTotal>
                     <cbc:TaxAmount currencyID="' . $v['moneda'] . '">' . $v['igv_total'] . '</cbc:TaxAmount>';

            if ($v['codigo_afectacion'] != '1000') {
                $xml .= '<cac:TaxSubtotal>
                         <cbc:TaxAmount currencyID="' . $v['moneda'] . '">' . $v['igv_total'] . '</cbc:TaxAmount>
                         <cac:TaxCategory>
                             <cac:TaxScheme>
                                 <cbc:ID>' . $v['codigo_afectacion'] . '</cbc:ID>
                                 <cbc:Name>' . $v['nombre_afectacion'] . '</cbc:Name>
                                 <cbc:TaxTypeCode>' . $v['tipo_afectacion'] . '</cbc:TaxTypeCode>
                             </cac:TaxScheme>
                         </cac:TaxCategory>
                     </cac:TaxSubtotal>';
            }

            $xml .= '<cac:TaxSubtotal>
                         <cbc:TaxAmount currencyID="' . $v['moneda'] . '">' . $v['igv_total'] . '</cbc:TaxAmount>
                         <cac:TaxCategory>
                             <cac:TaxScheme>
                                 <cbc:ID>1000</cbc:ID>
                                 <cbc:Name>IGV</cbc:Name>
                                 <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                             </cac:TaxScheme>
                         </cac:TaxCategory>
                     </cac:TaxSubtotal>';

            $xml .= '</cac:TaxTotal>
             </sac:SummaryDocumentsLine>';
        }

        $xml .= '</SummaryDocuments>';

        $doc->loadXML($xml);
        $doc->save($nombrexml . '.XML');
    }

    /**
     * 
     * @param type $emisor
     * @param type $cabecera
     * @param type $detalle
     * @param type $nombrexml
     */
    function CrearXmlBajaDocumentos($emisor, $cabecera, $detalle, $nombrexml) {
        $doc = new DOMDocument();
        $doc->formatOutput = FALSE;
        $doc->preserveWhiteSpace = TRUE;
        $doc->encoding = 'utf-8';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <VoidedDocuments xmlns="urn:sunat:names:specification:ubl:peru:schema:xsd:VoidedDocuments-1" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:sac="urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
          <ext:UBLExtensions>
              <ext:UBLExtension>
                  <ext:ExtensionContent />
              </ext:UBLExtension>
          </ext:UBLExtensions>
          <cbc:UBLVersionID>2.0</cbc:UBLVersionID>
          <cbc:CustomizationID>1.0</cbc:CustomizationID>
          <cbc:ID>' . $cabecera['tipodoc'] . '-' . $cabecera['serie'] . '-' . $cabecera['correlativo'] . '</cbc:ID>
          <cbc:ReferenceDate>' . $cabecera['fecha_emision'] . '</cbc:ReferenceDate>
          <cbc:IssueDate>' . $cabecera['fecha_envio'] . '</cbc:IssueDate>
          <cac:Signature>
              <cbc:ID>' . $cabecera['tipodoc'] . '-' . $cabecera['serie'] . '-' . $cabecera['correlativo'] . '</cbc:ID>
              <cac:SignatoryParty>
                  <cac:PartyIdentification>
                      <cbc:ID>' . $emisor['ruc'] . '</cbc:ID>
                  </cac:PartyIdentification>
                  <cac:PartyName>
                      <cbc:Name><![CDATA[' . utf8_encode($emisor['razon_social']) . ']]></cbc:Name>
                  </cac:PartyName>
              </cac:SignatoryParty>
              <cac:DigitalSignatureAttachment>
                  <cac:ExternalReference>
                      <cbc:URI>' . $cabecera['tipodoc'] . '-' . $cabecera['serie'] . '-' . $cabecera['correlativo'] . '</cbc:URI>
                  </cac:ExternalReference>
              </cac:DigitalSignatureAttachment>
          </cac:Signature>
          <cac:AccountingSupplierParty>
              <cbc:CustomerAssignedAccountID>' . $emisor['ruc'] . '</cbc:CustomerAssignedAccountID>
              <cbc:AdditionalAccountID>' . $emisor['tipodoc'] . '</cbc:AdditionalAccountID>
              <cac:Party>
                  <cac:PartyLegalEntity>
                      <cbc:RegistrationName><![CDATA[' . utf8_encode($emisor['razon_social']) . ']]></cbc:RegistrationName>
                  </cac:PartyLegalEntity>
              </cac:Party>
          </cac:AccountingSupplierParty>';

        foreach ($detalle as $k => $v) {
            $xml .= '<sac:VoidedDocumentsLine>
                 <cbc:LineID>' . $v['item'] . '</cbc:LineID>
                 <cbc:DocumentTypeCode>' . $v['tipodoc'] . '</cbc:DocumentTypeCode>
                 <sac:DocumentSerialID>' . $v['serie'] . '</sac:DocumentSerialID>
                 <sac:DocumentNumberID>' . $v['correlativo'] . '</sac:DocumentNumberID>
                 <sac:VoidReasonDescription><![CDATA[' . utf8_encode($v['motivo']) . ']]></sac:VoidReasonDescription>
             </sac:VoidedDocumentsLine>';
        }

        $xml .= '</VoidedDocuments>';

        $doc->loadXML($xml);
        $doc->save($nombrexml . '.XML');
    }
    function CrearXMLGuiaRemision(
      $nombrexml,
      $emisor,
      $cliente,
      $comprobante,
      $detalle
) {

  $doc = new DOMDocument();
  $doc->formatOutput = FALSE;
  $doc->preserveWhiteSpace = TRUE;
  $doc->encoding = 'utf-8';

  $xml = '';
  $xml .= '<DespatchAdvice xmlns="urn:oasis:names:specification:ubl:schema:xsd:DespatchAdvice-2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2">
              <ext:UBLExtensions>
                <ext:UBLExtension>
                    <ext:ExtensionContent />
                </ext:UBLExtension>
            </ext:UBLExtensions>
            <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
            <cbc:CustomizationID>1.0</cbc:CustomizationID>
            <cbc:ID>' . $comprobante['despatch_id'] . '</cbc:ID>
            <cbc:IssueDate>' . $comprobante['issueDate'] . '</cbc:IssueDate>
            <cbc:IssueTime>' . $comprobante['issueTime'] . '</cbc:IssueTime>
            <cbc:DespatchAdviceTypeCode>09</cbc:DespatchAdviceTypeCode>
            <cbc:Note><![CDATA[ ' . $comprobante['note'] . ' ]]></cbc:Note>';

//        $xml .= '   <cac:AdditionalDocumentReference>
//                      <cbc:ID>213123</cbc:ID>
//                      <cbc:DocumentTypeCode listAgencyName="PE:SUNAT" listName="SUNAT:Identificador de documento relacionado" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo21">02</cbc:DocumentTypeCode>
//                  </cac:AdditionalDocumentReference>';

  $xml .= '   <cac:DespatchSupplierParty>
                <cbc:CustomerAssignedAccountID schemeID="6">' . $comprobante['partyIdentification'] . '</cbc:CustomerAssignedAccountID>
                <cac:Party>
                    <cac:PartyLegalEntity>
                        <cbc:RegistrationName><![CDATA[ ' . $comprobante['partyName'] . ' ]]></cbc:RegistrationName>
                    </cac:PartyLegalEntity>
                </cac:Party>
            </cac:DespatchSupplierParty> ';
  $xml .= '          
            <cac:DeliveryCustomerParty>
                <cbc:CustomerAssignedAccountID schemeID="' . $comprobante['deliverySchemeID'] . '">' . $comprobante['deliveryCustomerAccountID'] . '</cbc:CustomerAssignedAccountID>
                <cac:Party>
                    <cac:PartyLegalEntity>
                        <cbc:RegistrationName><![CDATA[ ' . $comprobante['deliveryName'] . ' ]]></cbc:RegistrationName>
                    </cac:PartyLegalEntity>
                </cac:Party>
            </cac:DeliveryCustomerParty> ';

  if (strlen($comprobante['sellerSupplierAccountID']) > 0) {
      $xml .= ' <cac:SellerSupplierParty>
                <cbc:CustomerAssignedAccountID schemeID="' . $comprobante['sellerSupplierSchemeID'] . '">' . $comprobante['sellerSupplierAccountID'] . '</cbc:CustomerAssignedAccountID>
                <cac:Party>
                    <cac:PartyLegalEntity>
                        <cbc:RegistrationName><![CDATA[' . $comprobante['sellerSupplierName'] . ' ]]></cbc:RegistrationName>
                    </cac:PartyLegalEntity>
                </cac:Party>
            </cac:SellerSupplierParty>';
  }
  
  $xml .= '          
            <cac:Shipment>
                <cbc:ID>1</cbc:ID>
                <cbc:HandlingCode>' . $comprobante['handlingCode'] . '</cbc:HandlingCode>
                <cbc:Information>' . $comprobante['information'] . '</cbc:Information>
                <cbc:GrossWeightMeasure unitCode="' . $comprobante['grossWeightMeasure'] . '">' . $comprobante['despatch_uid'] . '</cbc:GrossWeightMeasure>
                <cbc:SplitConsignmentIndicator>' . $comprobante['splitConsignmentIndicator'] . '</cbc:SplitConsignmentIndicator>
                <cac:ShipmentStage>
                
                    <cbc:TransportModeCode>' . $comprobante['transportModeCode'] . '</cbc:TransportModeCode>
                    <cac:TransitPeriod>
                        <cbc:StartDate>' . $comprobante['startDate'] . '</cbc:StartDate>
                    </cac:TransitPeriod> ';
  $xml .= '              
                    <cac:CarrierParty>
                        <cac:PartyIdentification>
                            <cbc:ID schemeID="' . $comprobante['carrierSchemeId'] . '">' . $comprobante['carrierPartyId'] . '</cbc:ID>
                        </cac:PartyIdentification>
                        <cac:PartyName>
                            <cbc:Name><![CDATA[ ' . $comprobante['carrierPartyName'] . ' ]]></cbc:Name>
                        </cac:PartyName>
                    </cac:CarrierParty>';

  if (strlen($comprobante['licensePlateId']) > 0) {
      $xml .= '              
                    <cac:TransportMeans>
                        <cac:RoadTransport>
                            <cbc:LicensePlateID>' . $comprobante['licensePlateId'] . '</cbc:LicensePlateID>
                        </cac:RoadTransport>
                    </cac:TransportMeans> ';
  }

  if (strlen($comprobante['driverPersonschemeId']) > 0) {
      $xml .= '              
                    <cac:DriverPerson>
                        <cbc:ID schemeID="' . $comprobante['driverPersonschemeId'] . '">' . $comprobante['driverPersonId'] . '</cbc:ID>
                    </cac:DriverPerson> ';
  }

  $xml .= '              
                </cac:ShipmentStage> ';

  $xml .= '
                <cac:Delivery>
                    <cac:DeliveryAddress>
                        <cbc:ID>' . $comprobante['deliveryAddressId'] . '</cbc:ID>
                        <cbc:StreetName>' . $comprobante['deliveryStreetName'] . '</cbc:StreetName>
                    </cac:DeliveryAddress>
                </cac:Delivery> ';

  if (strlen($comprobante['transportEquipmentId']) > 0) {
      $xml .= '
                <cac:TransportHandlingUnit>
                    <cbc:ID>' . $comprobante['transportEquipmentId'] . '</cbc:ID>
                </cac:TransportHandlingUnit> ';
  }

  $xml .= '
                <cac:OriginAddress>
                    <cbc:ID>' . $comprobante['originAddressId'] . '</cbc:ID>
                    <cbc:StreetName>' . $comprobante['originAddressStreetName'] . '</cbc:StreetName>
                </cac:OriginAddress> ';

  if (strlen($comprobante['firstArrivalPortLocation']) > 0) {
      $xml .= '
                <cac:FirstArrivalPortLocation>
                    <cbc:ID>' . $comprobante['firstArrivalPortLocation'] . '</cbc:ID>
                </cac:FirstArrivalPortLocation> ';
  }


  $xml .= '
            </cac:Shipment>';

  foreach ($detalle as $k => $v) {

      $xml .= '<cac:DespatchLine>
                <cbc:ID>' . $v['lineId'] . '</cbc:ID>
                <cbc:DeliveredQuantity unitCode="' . $v['unitCode'] . '">' . $v['deliveredQuantity'] . '</cbc:DeliveredQuantity>
                <cac:OrderLineReference>
                    <cbc:LineID>' . $v['lineId'] . '</cbc:LineID>
                </cac:OrderLineReference>
                <cac:Item>
                    <cbc:Name><![CDATA[' . $v['nameProduct'] . ' ]]></cbc:Name>
                    <cac:SellersItemIdentification>
                        <cbc:ID>' . $v['sellersItemIdentification'] . '</cbc:ID>
                    </cac:SellersItemIdentification>
                    <cac:CommodityClassification>
                        <cbc:ItemClassificationCode listID="UNSPSC" listAgencyName="GS1 US" listName="Item Classification">10000000</cbc:ItemClassificationCode>
                    </cac:CommodityClassification>
                </cac:Item>
            </cac:DespatchLine> ';
  }

  $xml .= '  </DespatchAdvice>';

  //print_r($comprobante);
  $doc->loadXML($xml);
  $doc->save($nombrexml . '.XML');
}

}
