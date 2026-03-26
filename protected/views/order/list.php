<!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->

<script>
    // $(document).ready(function() {
    //     new DataTable('#orderTable');
    // } );
</script>

<style>
    .sorting_1:hover .EditBtn {
        opacity: 1 !important;
        transition: .3s ease-in-out;
    }

    .sorting_1:hover button {
        display: block;
    }

    .sorting_1 button {
        display: none;
        transition: .3s ease-in-out;
    }

    .emptyrow h6 {
        color: #FFF;
        position: relative;
        height: 100%;
        text-transform: uppercase;
        margin: 0;
        font-size: 14px;
        padding: 8px 0px;
        font-weight: 500;
        letter-spacing: 1px;
        font-family: helvetica neue, Roboto, Arial, droid sans, sans-serif;

    }

    #orderTable {
        width: 100% !important;
    }

    .emptyrow::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        background: #363636;
    }

    .emptyrow::after {
        content: '';
        position: absolute;
        right: -3px;
        top: 0;
        height: 100%;
        width: 3px;
        background: #363636;
        z-index: 1;
    }

    .right_col #orderTable_wrapper {
        font-family: Tahoma, "Trebuchet MS", sans-serif;
    }

    .form-inline select {
        padding: 5px 10px;
        background: #337ab714;
        border: 1px solid #337ab74d;
        box-shadow: rgb(0 0 0 / 3%) 0px 3px 8px;
        /* width: 170px; */
        border-radius: 2px;
        height: 35px;
        margin: auto 0;
        font-size: 12px;
    }

    .form-inline input {
        margin: 0 5px;
    }

    .form-inline .form-group {
        display: flex;
    }

    form.form-inline {
        line-height: 40px;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .form-inline label {

        font-weight: 500;
        font-size: 12px;
        margin: 0 5px 0 0;

    }

    .x_content {
        margin-top: 5px;
    }



    .x_title {
        padding: 7px 12px 12px 12px;
        margin: 0;
    }

    .dt-buttons .buttons-copy {
        background: #337AB7;
    }

    .dt-buttons .dt-button {
        color: #fff;
        border: none;
        font-size: 13px;
        letter-spacing: 1px;
        padding: 5px 20px;
        font-weight: 100;
        float: left;
        margin: 0 3px 10px 3px;
    }

    .dt-buttons .dt-button:hover {
        color: #2A3F54;
        border: none;
    }

    .x_panel {
        margin: 50px 0 !important;
    }

    th {
        font-size: 13px !important;
        font-weight: 100 !important;
    }

    .dataTables_wrapper .dataTables_filter {
        float: right;
        margin: 0 0 5px 0;
        display: inline-block;
    }

    #orderTable_length label {
        margin-bottom: 0;
        color: #2A3F54;
        font-size: 12px;
        font-weight: 400;
        text-transform: capitalize;
        background: #FFF;
        padding: 4px 10px;
    }

    .dt-button {
        border: none;
    }

    .dt-buttons .buttons-csv {
        background: #EA6153;
    }

    .dt-buttons .buttons-excel {
        background: #107C41;
    }

    .dt-buttons .buttons-copy {
        background: #0F62FE;
    }

    .dt-buttons .buttons-print {
        background: #007C89;
    }

    #orderTable thead {
        background: #C7C6C1;
        color: #000;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    #orderTable th {
        font-size: 12px !important;
        font-weight: 600 !important;
    }

    #orderTable td {
        border-right: 1px solid #b7b4b466;
        border-left: 1px solid #b7b4b466;
        text-align: center;
    }

    #orderTable span.commcar {
        color: #337AB7;
        font-weight: 700;
        background: #337ab721;
        padding: 5px;
        font-size: 12px;
        cursor: not-allowed;
    }

    #orderTable select {
        background: #ECF3F9;
        border: 1px solid #bfc1c3;
        padding: 4px 0;
        border-radius: 2px;
        min-width: 100px;
        scrollbar-width: none;
        cursor: pointer;
        font-size: 11px;
        padding: 5px;
        color: #262626d6;
    }

    .x_panel {
        padding: 0;
        margin: 0;
        border: none;
        padding: 10px;
        border: 1px solid #E6E9ED;
    }

    #orderTable_filter input {
        background: #FFF;
        /* border: 2px solid #337AB7; */
        width: 210px;
        padding: 4px 10px;
        /* border-radius: 30px; */
        margin-left: 20px;
        font-size: 14px;
        color: #000;
    }

    /* data table  */


    table.dataTable tbody th,
    table.dataTable tbody td {
        padding: 2px 4px !important;
        vertical-align: middle;
        font-size: 12px;

    }

    /* data table  */
    .dataTables_wrapper .dataTables_filter {
        position: absolute;
        right: 0;
        width: auto;
    }

    .dataTables_length label {
        margin-bottom: 0;
    }

    table.dataTable tbody td {
        color: #7e7e7e !important;
    }

    .dynamic-selected-month {
        background: #363636;
        padding: 10px;
        font-size: 14px;
        text-align: center;
        text-transform: uppercase;
        color: #FFF;
        letter-spacing: 1px;
        margin: 2px 0;
    }

    footer {
        height: auto;
        background: none;
    }

    table.dataTable.no-footer {
        margin-bottom: 10px;
    }

    #orderTable_paginate {
        margin-bottom: 10px;
    }

    .copyright-info {
        line-height: 30px;
    }

    .multiSelect span {
        color: #337AB7;
    }

    .hide-columns-sec #columnSelector {
        width: 100%;
    }


    /* ******************* */

    .multiSelect {
        position: relative;
    }

    .multiSelect *,
    .multiSelect *::before,
    .multiSelect *::after {
        box-sizing: border-box;
    }

    .multiSelect_dropdown {
        font-size: 14px;
        min-height: 42px;
        line-height: 34px;
        border-radius: 4px;
        box-shadow: none;
        outline: none;
        background-color: #fff;
        color: #444f5b;
        background: #337ab717;
        font-weight: 400;
        padding: 0.5px 13px;
        margin: 0;
        transition: .1s border-color ease-in-out;
        cursor: pointer;
    }

    .multiSelect_dropdown.-hasValue {
        padding: 5px 30px 5px 5px;
        cursor: default;
        background: #FFF;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }

    .multiSelect_dropdown.-open {
        box-shadow: none;
        outline: none;
        background: #ECF3F9;
        padding: 4.5px 29.5px 4.5px 4.5px;
        border: 1.5px solid #337AB7;
    }

    .multiSelect_arrow::before,
    .multiSelect_arrow::after {
        content: '';
        position: absolute;
        display: block;
        width: 2px;
        height: 8px;
        border-radius: 20px;
        border-bottom: 8px solid #99A3BA;
        top: 40%;
        transition: all .15s ease;
    }

    .multiSelect_arrow::before {
        right: 18px;
        -webkit-transform: rotate(-50deg);
        transform: rotate(-50deg);
    }

    .multiSelect_arrow::after {
        right: 13px;
        -webkit-transform: rotate(50deg);
        transform: rotate(50deg);
    }

    .multiSelect_list {
        margin: 0;
        margin-bottom: 25px;
        padding: 0;
        list-style: none;
        opacity: 0;
        visibility: hidden;
        position: absolute;
        max-height: calc(10 * 31px);
        top: 28px;
        left: 0;
        z-index: 9999;
        right: 0;
        background: #fff;
        border-radius: 4px;
        overflow-x: hidden;
        overflow-y: auto;
        -webkit-transform-origin: 0 0;
        transform-origin: 0 0;
        transition: opacity 0.1s ease, visibility 0.1s ease, -webkit-transform 0.15s cubic-bezier(0.4, 0.6, 0.5, 1.32);
        transition: opacity 0.1s ease, visibility 0.1s ease, transform 0.15s cubic-bezier(0.4, 0.6, 0.5, 1.32);
        transition: opacity 0.1s ease, visibility 0.1s ease, transform 0.15s cubic-bezier(0.4, 0.6, 0.5, 1.32), -webkit-transform 0.15s cubic-bezier(0.4, 0.6, 0.5, 1.32);
        -webkit-transform: scale(0.8) translate(0, 4px);
        transform: scale(0.8) translate(0, 4px);
        border: 1px solid #d9dbde;
        box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.12);
    }

    .multiSelect_option {
        margin: 0;
        padding: 0;
        opacity: 0;
        -webkit-transform: translate(6px, 0);
        transform: translate(6px, 0);
        transition: all .15s ease;
    }

    .multiSelect_option.-selected {
        display: none;
    }

    .multiSelect_option:hover .multiSelect_text {
        color: #fff;
        background: #4d84fe;
    }

    .multiSelect_text {
        cursor: pointer;
        display: block;
        padding: 5px 13px;
        color: #525c67;
        font-size: 14px;
        text-decoration: none;
        outline: none;
        position: relative;
        transition: all .15s ease;
    }

    .multiSelect_list.-open {
        opacity: 1;
        visibility: visible;
        -webkit-transform: scale(1) translate(0, 12px);
        transform: scale(1) translate(0, 12px);
        transition: opacity 0.15s ease, visibility 0.15s ease, -webkit-transform 0.15s cubic-bezier(0.4, 0.6, 0.5, 1.32);
        transition: opacity 0.15s ease, visibility 0.15s ease, transform 0.15s cubic-bezier(0.4, 0.6, 0.5, 1.32);
        transition: opacity 0.15s ease, visibility 0.15s ease, transform 0.15s cubic-bezier(0.4, 0.6, 0.5, 1.32), -webkit-transform 0.15s cubic-bezier(0.4, 0.6, 0.5, 1.32);
    }

    .multiSelect_list.-open+.multiSelect_arrow::before {
        -webkit-transform: rotate(-130deg);
        transform: rotate(-130deg);
    }

    .multiSelect_list.-open+.multiSelect_arrow::after {
        -webkit-transform: rotate(130deg);
        transform: rotate(130deg);
    }

    .multiSelect_list.-open .multiSelect_option {
        opacity: 1;
        -webkit-transform: translate(0, 0);
        transform: translate(0, 0);
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(1) {
        transition-delay: 10ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(2) {
        transition-delay: 20ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(3) {
        transition-delay: 30ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(4) {
        transition-delay: 40ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(5) {
        transition-delay: 50ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(6) {
        transition-delay: 60ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(7) {
        transition-delay: 70ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(8) {
        transition-delay: 80ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(9) {
        transition-delay: 90ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(10) {
        transition-delay: 100ms;
    }

    .multiSelect_choice {
        background: rgba(77, 132, 254, 0.1);
        color: #444f5b;
        padding: 1px 8px;
        line-height: 17px;
        margin: 5px;
        display: inline-block;
        font-size: 13px;
        border-radius: 30px;
        cursor: pointer;
        font-weight: 500;
    }

    .multiSelect_deselect {
        width: 12px;
        height: 12px;
        display: inline-block;
        stroke: #b2bac3;
        stroke-width: 4px;
        margin-top: -4px;
        margin-left: 10px;
        vertical-align: middle;
    }

    .multiSelect_choice:hover .multiSelect_deselect {
        stroke: #a1a8b1;
    }

    .multiSelect_noselections {
        text-align: center;
        padding: 7px;
        color: #b2bac3;
        font-weight: 450;
        margin: 0;
    }

    .multiSelect_placeholder {
        position: absolute;
        left: 10px;
        font-size: 13px;
        top: 6px;
        padding: 0px 10px;
        background-color: #fff;
        color: #337AB7;
        font-weight: 500;
        pointer-events: none;
        transition: all .1s ease;
    }

    .multiSelect_dropdown.-open+.multiSelect_placeholder,
    .multiSelect_dropdown.-open.-hasValue+.multiSelect_placeholder {
        top: -11px;
        left: 17px;
        color: #FFF;
        padding: 1px 15px;
        background: #337AB7;
        font-size: 13px;
    }

    .multiSelect_dropdown.-hasValue+.multiSelect_placeholder {
        top: -14px;
        left: 50%;
        color: #FFF;
        background: #337AB7;
        font-size: 13px;
    }

    /* ******************* */
    .commission-modal .modal-dialog {
        width: 50% !important;
    }



    option[value] {
        background: #3379b71f;
        line-height: 30px;
        padding: 10px;
        font-size: 12px;
        color: #000000b2;
        cursor: pointer;
    }

    .flex-header .close span {
        line-height: 30px;
        font-size: 25px;
        font-weight: 600;
    }

    .flex-header .modal-title {
        font-size: 17px;
    }

    .flex-header {
        display: flex;
    }

    .flex-header .close {
        color: #337AB7;
        position: absolute;
        right: 20px;
        top: 12px;
        padding: 1px 10px;
        background: #CED5DB;
    }

    .hide-columns-sec option {
        padding: 5px 10px;
    }

    .hide-columns-sec {
        display: flex;
    }

    .hide-columns-sec .dropdown-side {
        width: 100%;
    }


    label {
        font-size: 14px;
        text-transform: capitalize;
        font-weight: 400;
    }

    .commission-modal .modal-body {
        min-height: 330px;
        padding: 15px;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .commission-modal .col-6 {
        border: 1px solid #eee;
        margin: 20px;
        padding: 20px;
        text-align: center;
        border-radius: 10px;
        background: #eeeeeea1;
    }

    .commission-modal .col-6 .btn {
        width: 100%;
    }

    #Add-multiple-table-modal .modal-dialog,
    #addwutnew .modal-dialog {
        width: 90% !important;
    }

    /* #Add-multiple-table-modal .modal-body {
        overflow-x: scroll;
    } */

    #Add-multiple-table-modal #rowButton,
    #addwutnew #rowButton {
        background-color: #337AB7;
    }

    #Add-multiple-table-modal input,
    #addwutnew input {
        padding: 5px 10px;
    }

    #Add-multiple-table-modal .modal-footer input,
    #addwutnew .modal-footer input {
        padding: 8px 10px;
    }

    #Add-multiple-table-modal th,
    #addwutnew th {
        background: #337AB7;
        color: #FFF;
        padding: 10px !important;
    }

    #Add-multiple-table-modal tbody input,
    #addwutnew tbody input {
        width: 100%;
        border: none;
        background: #337ab714;
        text-transform: capitalize;

    }

    #Add-multiple-table-modal table td,
    #addwutnew table td {
        padding: 0 !important;
        background: #337ab714;
        border: 1px solid #337ab761;
        text-align: center;
        vertical-align: middle;
    }

    #Add-multiple-table-modal .delete-btn,
    #addwutnew .delete-btn {
        background: #EA6153;
        color: #FFF;
        padding: 7px;
        border-radius: 50%;
        width: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 5px auto;
        height: 25px;
    }

    #Add-multiple-table-modal select,
    #addwutnew select {
        width: 120px;
        padding: 8px;
        text-transform: capitalize;
        background: #E1ECF6;
        border: none;
    }

    .invlink-modal .modal-dialog {
        width: 50% !important;
    }

    .dataTables_wrapper tr td .invlink .edit-icon-admin,
    .dataTables_wrapper tr td .invlink .edit-icon-sales {
        right: 2px !important;
        top: 5px !important;
        transform: translateY(0) !important;
    }

    .dataTables_wrapper tr td .invlink .edit-icon-admin i,
    .dataTables_wrapper tr td .invlink .edit-icon-sales i {
        background: none !important;
        font-size: 14px;
        padding: 0 !important;
    }

    .dataTables_wrapper tr:hover i.fa.fa-pencil {
        color: #337AB7 !important;

    }

    .dataTables_wrapper tr td .invlink .edit-icon-admin:hover i.fa.fa-pencil,
    .dataTables_wrapper tr td .invlink .edit-icon-sales:hover i.fa.fa-pencil,
    .dataTables_wrapper tr td .invlink:hover i.fa.fa-pencil {
        background: #E0E9F1 !important;
    }


    .invlink:hover i.fa.fa-pencil {
        color: #797976 !important;
        padding: 4px !important;

    }

    .invlink-modal .form-control {
        padding: 0 10px;
    }

    #orderTable td .btn {
        padding: 3px;
        font-size: 11px;
        margin: 0;
    }

    .dataTables_length {
        float: unset;
        display: inline-block;
    }

    div#orderTable_length {
        position: absolute;
        top: -44px;
        left: 1px;
    }

    div#orderTable_filter {
        position: absolute;
        top: -43px;
    }

    #orderTable_filter label {
        color: #FFF;
    }

    .greentd {
        position: absolute;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;

    }





    #orderTable .greentd input[type=checkbox] {
        width: 18px;
        height: 18px;
    }



    .show_comm {
        display: none;
    }

    .search-month-year .dflex {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-direction: column;
    }

    .search-month-year .form-inline {
        justify-content: space-between;
        position: relative;
    }

    .search-month-year .form-inline .form-control {
        padding: 10px 10px;
        background: #c7c6c19c;
        color: #000;
        height: 35px;
        margin: 0 5px 0 0;
        width: 100% !important;
    }

    .search-month-year .form-inline .form-control::placeholder {
        color: #000;
    }

    .search-month-year .form-inline .btn-outline-success {
        margin: 0;
        /* background: #5CB85C; */
        background: #363636;
        color: #FFF;
        position: absolute;
        right: 0;
        padding: 10px;
        width: 40px;
        height: 35px;
        display: flex;
        align-content: center;
        border-radius: 0;
        justify-content: center;
    }

    .search-month-year .header-Search {
        width: 100%;
    }

    .search-month-year .header-Search2 {
        width: 95%;
    }

    input[type="radio"]:checked+label::before {
        background: radial-gradient(circle at center, #1062a4 .6ex, white .7ex);
    }

    #orderTable_wrapper .delete-btn {
        background: #EA6153;
        color: #FFF;
        padding: 7px;
        border-radius: 50%;
        width: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 5px auto;
        height: 25px;
    }

    #orderTable_wrapper {
        overflow-x: auto;
        margin-bottom: 20px;
        max-height: 70vh;
    }

    div#orderTable_filter {
        position: relative;
        top: 3px;
    }

    div#orderTable_length {
        position: relative;
        top: 3px;
    }

    .x_title h2 {
        font-size: 14px;
        padding: 4px 0;
        font-weight: 500;
    }

    #freebModal .modal-dialog {
        width: 50% !important;
    }

    #freebModal .form-control {
        padding: 6px;
    }

    #orderTable_wrapper td span {
        line-height: 20px;
        font-family: Tahoma, "Trebuchet MS", sans-serif;
    }

    #orderTable_wrapper td input {
        margin: 0 auto;
    }



    .text-center.editable-cell {
        /* white-space: nowrap; */
        font-weight: 600;
        color: #000000ba;
    }

    .text-center.text-left.editable-cell {
        text-align: left;
        padding-left: 8px;
    }

    .indu-center {
        text-align: left;
    }



    #adminCommentModal .modal-dialog {
        max-width: 60% !important;
    }

    #adminCommentModal .form-horizontal .control-label {
        width: 100%;
        text-align: left;
        margin-bottom: 5px;
    }

    #adminCommentModal .col-sm-10 {
        width: 100%;
    }

    #adminCommentModal .col-sm-offset-2 {
        margin-left: 0;
        text-align: right;
    }

    .checkbox {
        appearance: none;
        -webkit-appearance: none !important;
        width: 17px;
        height: 17px;
        background-color: white;
        border: 1px solid #555555bd;
        border: 2px solid #ccc;
        border-radius: 2px;
        outline: none;
        cursor: pointer;
        position: relative;
        /* transition: background-color 0.2s, transform 0.2s; */
        /* Add transition for background-color and transform */
    }


    .checkbox::after {
        content: '\2713';
        /* Unicode character for checkmark */
        font-size: 14px;
        /* Adjust size as needed */
        color: white;
        /* Color of the checkmark */
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        /* Initially hidden */
    }

    /* Show the tick icon when the checkbox is checked */
    .checkbox:checked::after {
        opacity: 1;
    }


    .bluetd .checkbox:checked {
        border: none;
        background-color: #3A8BD0 !important;
        /* Blue */
    }

    .greentd .checkbox:checked {
        border: none;
        background-color: #5CB85C !important;
        /* Green */
    }

    /* Reset background color when unchecked */
    .checkbox:not(:checked) {
        background-color: #FFF;
        border: 1px solid #555555bd;
    }

    /* Button push animation */
    .checkbox:active {
        transform: translateY(5px);
    }

    /* Type COlor Pallet  */
    .TypeColorFetch {
        display: flex;
        align-content: center;
        justify-content: center;
    }

    .TypeColorFetch .innerBox,
    .TypeColorFetch .innerBoxsales {
        border-radius: 50%;
        width: 30px;
        height: 30px;
        color: #181818;
        font-weight: 500;
        cursor: pointer;
        text-align: center;
        align-content: center;
        font-family: Candara, Calibri, Segoe, Segoe UI, Optima, Arial, sans-serif;
        text-transform: uppercase;
    }

    .ShowTypeColorPallet .innerBox {
        width: 35px;
        height: 35px;
    }

    .TypeColorFetch .innerBox h6 {
        font-size: 16px;
        font-weight: 500;
        margin: 0;

    }

    .onClickTypeColorFetch {
        display: flex;
        align-content: center;
        justify-content: center;
        background: #EEE;
        margin: -5px auto 5px;
        padding: 5px;
        gap: 10px;
        position: absolute;
        left: -60px;
        z-index: 1;
        box-shadow: rgba(0, 0, 0, 0.17) 0px 5px 15px;
        border: 1px solid #5553;
        border-radius: 41px;
    }

    .TypeColorFetch .defaultActive {
        color: #000;
        font-size: 14px;
    }

    .onClickTypeColorFetch .innerBox .text-secondary {
        color: #000;
    }

    #if_click {
        /* background: #CCC; */
        color: #000;

        background: rgba(255, 255, 255, 0.27);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10.2px);
        -webkit-backdrop-filter: blur(10.2px);
        border: 1px solid rgba(217, 217, 217, 0.33);
    }

    #if_Default {
        /* background: #CCC; */
        color: #000;

        background: rgba(255, 255, 255, 0.27);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10.2px);
        -webkit-backdrop-filter: blur(10.2px);
        border: 1px solid rgba(217, 217, 217, 0.33);
    }

    #if_Remake {
        background: #DBA979;
    }

    #if_NewOrder {
        background: #D2E0FB;
    }

    #if_Cancel {
        background: #D37676;
    }

    #if_Free {
        background: #F1F7B5;
    }

    #if_Online {
        background: #AFD198;
    }

    #if_Sample {
        background: #B5C0D0;
    }

    #if_Reorder {
        background: #EED3D9;
    }

    .D {
        /* background: #CCC !important; */
        color: #000;
        background: rgba(255, 255, 255, 0.27);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10.2px);
        -webkit-backdrop-filter: blur(10.2px);
        border: 1px solid rgba(217, 217, 217, 0.33);
    }

    .RM {
        background: #DBA979 !important;
    }

    .N {
        background: #D2E0FB !important;
    }

    .CC {
        background: #D37676 !important;
    }

    .F {
        background: #F1F7B5 !important;
    }

    .ON {
        background: #AFD198 !important;
    }

    .S {
        background: #B5C0D0 !important;
    }

    .Ro {
        background: #EED3D9 !important;
    }

    .ShowTypeColorPallet {
        display: none;
    }

    .ShowTypeColorPallet .innerBox:active {
        transform: translateY(10px);
    }

    .TypeColorFetch:hover .ShowTypeColorPallet {
        display: block;
        transition: .3s ease;
    }

    .TypeColorBAr .colorCode {
        width: 35px;
        height: 35px;
        display: flex;
        align-content: center;
        justify-content: center;
        vertical-align: middle;
        border-radius: 50%;
    }

    .TypeColorBAr .card {
        display: flex;
        align-content: center;
        justify-content: space-between;
        border: 1px solid #eaeaea;
        padding: 10px;
        width: 80%;
        border-radius: 2px;
        margin: 0 auto;
    }

    .TypeColorBAr .d-flex {
        display: flex;
        align-content: center;
        justify-content: center;
    }

    .TypeColorBAr span {
        color: #0000005e;
        position: relative;
        bottom: -5px;
        font-weight: bolder;

    }

    .TypeColorBAr .d-flex h6 {
        font-size: 12px;
        color: #000000d9;
        margin: auto 10px;
        font-weight: revert;
        text-transform: uppercase;

    }

    .TypeColorBAr .colorCode h6 {
        font-weight: 600;
    }

    .commentBtnIcon {
        background: none;
    }

    .commentBtnIcon:active {
        background: none;
        box-shadow: none;

        transform: translateY(5px);
    }

    .commentBtnIcon img {
        width: 30px;
        height: 30px;
        background: #363636;
        border-radius: 50%;
        padding: 6px;
        object-fit: cover;
    }

    .commentBtnIconInfo img {

        background: #5BC0DE;
    }

    #orderTable tr th.jogCodeTH {
        white-space: nowrap;
    }

    #orderTable tr th.noCodeTH,
    #orderTable tr th.qbDraftTH {
        width: 42px !important;
    }


    #orderTable tr th.typeTH {
        width: 45px !important;
    }

    #orderTable tr th.orderNameTH {
        min-width: 420px !important;
    }

    #orderTable tr th.invNoTH {
        min-width: 150px !important;

    }

    #orderTable tr th.percentage1TH,
    #orderTable tr th.percentage1TH {
        min-width: 40px !important;
    }


    #orderTable tr th.salesRepTH2,
    #orderTable tr th.salesRepTH1 {
        min-width: 110px !important;

    }



    /* Type COlor Pallet  */

    @media screen and (max-width: 1500px) {
        #orderTable td {
            padding: 3px !important;
        }

        table.dataTable {
            border-collapse: collapse !important;
        }

        #orderTable th {
            font-size: 12px !important;
        }

        #orderTable tr th.invNoTH {
            min-width: 130px;
        }

        #orderTable tr th.salesRepTH2,
        #orderTable tr th.salesRepTH1 {
            min-width: 90px !important;
            width: 100% !important;
        }

        #orderTable tr th.percentage1TH,
        #orderTable tr th.percentage1TH {
            min-width: 30px;
        }
    }

    .onclickUpload {
        background: #337ab72e;
        border-color: #337ab7ad;
        color: #337AB7;
    }

    .onclickUpload:hover {
        background: #337ab72e;
        border-color: #337ab7ad;
        color: #337AB7;
    }

    .onclickUpload:focus {
        background: #337ab72e;
        border-color: #337ab7ad;
        color: #337AB7;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #FDFDFD !important;
    }

    #orderTable th {
        text-align: center;
        padding: 10px 0;
    }

    .jogcode {
        display: flex;
        border-image-slice: c;
        justify-content: center;
        gap: 5px;
        height: 30px;
        white-space: nowrap;
        min-width: 100px;
    }

    .invlink span {
        white-space: nowrap;

    }

    .jogcode a {
        font-size: 12px;
        padding-top: 5px;
    }




    .ArrowIcons {
        opacity: 0;
        color: #772;
        font-size: 13px;
    }

    .ArrowIcons:active {
        transform: translateY(10px);
    }

    .sorting_1:hover .ArrowIcons {
        opacity: 1;
        transition: .6s ease-in-out;

    }

    .selectall {
        font-size: 12px;
        font-weight: 500;
        white-space: nowrap;
    }

    @media screen and (max-width: 1400px) {

        div.dataTables_wrapper {
            overflow-x: auto;
        }

        #orderTable thead {
            top: 0;
        }

        .multiSelect_dropdown {
            min-height: 40px;
            margin: 5px 0;
        }

        .search-month-year .header-Search,
        .search-month-year .header-Search2 {
            width: 100%;
        }

        .TypeColorBAr .card {
            width: 100%;
        }

        .TypeColorBAr .colorCode {
            width: 30px;
            height: 30px;
        }

        #addwutnew .modal-body {
            overflow-x: scroll;
        }

        .TypeColorBAr .d-flex h6 {

            margin: auto 5px;
        }

        #Add-multiple-table-modal th {
            padding: 5px !important;
        }

        .top-left-side {
            width: 100%;
        }

        .hide-columns-sec {
            width: 40%;
            margin: 5px 0 0 0;
        }

        .multiSelect_dropdown {
            min-height: 35px;
        }

        .x_title h2 {
            padding: 0px;

        }

        .dataTables_wrapper .dataTables_filter {
            position: relative;
        }

        .dataTables_length {
            width: 25%;
        }
    }

    @media screen and (max-width:1350px) {
        div.dataTables_wrapper {
            overflow-x: scroll;
        }

        #orderTable select {
            font-size: 11px;
        }

        #Add-multiple-table-modal .modal-dialog {
            width: 95% !important;
        }

        #orderTable_wrapper td span {
            line-height: 17px;
        }

        #Add-multiple-table-modal .modal-body {
            padding: 15px 0;
            overflow-x: scroll;
        }



        #Add-multiple-table-modal th,
        #addwutnew th {
            padding: 5px !important;
        }

        .row.search-month-year {
            position: absolute;
            right: 0;
            top: 60px;
            background: #FFF;
        }

        .main-div {
            padding: 0;
        }

        div#orderTable_filter {
            position: relative;
            top: 0;
        }

        #orderTable_wrapper div.dt-buttons {
            top: 0 !important;
            position: relative;
            right: 35% !important;
        }

        div#orderTable_length {
            position: relative;
            top: 0;
        }

        #orderTable_filter label {
            color: #000;
        }
    }

    @media screen and (max-width: 981px) {
        #Add-multiple-table-modal .modal-body {
            overflow-x: scroll;
            padding: auto 0;

        }

        .multiSelect_dropdown {
            margin: 10px 0;
        }
    }

    @media screen and (max-width: 768px) {
        div.dataTables_wrapper {
            overflow-x: scroll;
        }

        .x_title .float {
            float: unset;
        }

        form.form-inline {
            line-height: 25px;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            justify-content: flex-start !important;
            margin: 0 0 10px 0;

        }
    }


    @media screen and (max-width: 520px) {
        .x_title {
            padding: 0 !important;
        }

        form.form-inline {
            display: block;
            width: 100% !important;
        }

        .row.search-month-year {
            position: relative;
            right: 0;
            top: 0;
        }

        .hide-columns-sec {
            width: 100%;
        }

        .Add-table-btn-side .btn {
            margin: 10px 0 0 0;
        }

        #orderTable_wrapper div.dt-buttons {
            right: 0 !important;
        }

        .invlink-modal form {
            overflow: hidden;
        }

        #Add-multiple-table-modal tbody input {
            width: 70px;

        }

        .invlink-modal .modal-dialog {
            width: 100% !important;
        }

        #Add-multiple-table-modal .modal-dialog {
            width: 100% !important;
        }

        .flex-header .modal-title {
            font-size: 16px;
            width: 80%;
        }

        .dt-buttons .dt-button {
            padding: 5px 14px;
        }

        #freebModal .modal-dialog {
            width: 100% !important;
        }

        #freebModal form {
            overflow: hidden;
        }

        .commission-modal .col-6 {
            margin: 5px !important;
        }

        .form-inline select {
            width: 100%;
            float: unset;
            margin: 0;
            padding: 6px;
        }

        form.form-inline {
            padding: 10px;
        }

        .commission-modal .modal-dialog {
            width: 100% !important;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            float: left;
            text-align: center;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #orderTable_filter {
            margin-top: -35px;

        }

        .x_panel {
            margin: 50px 0 !important;
        }

        .dynamic-selected-month {
            padding: 10px;
        }

        .x_content {
            margin-bottom: 30px;
            padding-bottom: 20px;
        }



        .search-month-year .form-inline {
            display: flex;
            align-items: center;
            justify-content: center;
        }


    }


    @media screen and (Max-width:1617px) {
        .form-inline select {
            width: 70%;
        }
    }

    @media screen and (min-device-width: 520px) and (max-device-width: 1700px) {
        #orderTable_wrapper div.dt-buttons {
            position: absolute;
            top: -145px;
            right: 6px;
        }
    }




    #orderTable_processing {
        position: absolute !important;
        left: 50% !important;
        top: 70% !important;
        z-index: 9990000 !important;
        height: auto !important;
        margin: -76px 0 0 -76px !important;

    }

    .dataTables_processing {
        height: 50px !important;

    }

    .removerowtb {
        cursor: pointer;
    }

    .sorting_1 {
        cursor: pointer;
    }

    .prnttbl {
        display: flex;
        align-self: flex-end;
        justify-content: center;
        margin-top: 30px;
    }

    #updataloading {
        border: 2px solid #D2D2D2;
        border-top: 3px solid #337AB7;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        animation: spin 2s linear infinite;
        margin: 5px 0 0 5px;
    }


    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .loaderdiv {
        display: flex;
        align-content: center;
    }

    .loaderdiv .btn-primary {
        width: 130px;
        position: relative;
    }

    /* splitform */
    .splitGreen {
        background: #FFF;
        border: 1px solid #5CB85C;
        color: #5CB85C;
    }

    .splitdef {
        background: #FFF;
        border: 1px solid #8d8d8d;
        color: #8d8d8d;
    }

    #split {
        padding: 4px 10px;
        margin-right: 10px;
        cursor: pointer;
        border-radius: 2px;
        position: relative;
        z-index: 1;
    }

    .formsplit .form__submit .grid2 {
        display: grid;
        grid-template-columns: auto auto;
        gap: 10px;
        margin: 10px 0;
    }

    .form__submit {
        background: #5CB85C1C;
        padding: 10px 5px;
        border: 1px solid #5CB85C;
        position: relative;
        top: -10px;
        border-radius: 4px;
    }

    .submitFormBtn {

        font-size: 14px !important;
        padding: 3px 10px;
        background: #5CB85C;

    }

    .fa.fa-mobile {
        font-size: 25px;
        color: #363636;
    }

    .fa.fa-envelope {
        color: #3479B5;
        font-size: 16px;
    }

    .jogcheckCol {
        display: flex;
        gap: 10px;
    }

    input[type=checkbox]:focus {
        outline: none !important;
    }

    .redtd .checkbox:checked::after,
    .bluetd .checkbox:checked::after,
    .greentd .checkbox:checked::after {
        content: '✔';
        color: white;
        font-size: 12px;
        position: absolute;
        width: 17px;
        height: 17px;
        border-radius: 2px;
        text-align: center;
        top: 8px;
    }

    .redtd .checkbox:checked::after {
        background: #EA6153;
    }

    .greentd .checkbox:checked::after {
        background: #5CB85C !important;
    }

    .bluetd .checkbox:checked::after {
        background: #3A8BD0;
    }

    .redtd:checked {
        accent-color: red;
    }

    .invsenddate {
        white-space: nowrap;
    }
</style>

<?php $user_group = Yii::app()->user->getState('userGroup');
$fullname = Yii::app()->user->getState('fullName');
$user_id = Yii::app()->user->getState('userKey');
$sq = "SELECT * FROM `user` WHERE `enable` = 1";
$users = Yii::app()->db->createCommand($sq)->queryAll();

if (isset($toc)) {
    $code_typetoc = '-' . $toc;
} else {
    $code_typetoc = '';
}
echo phpversion();

?>

<?php if ($user_group == "1" || $user_group == "99") { ?>
    <style>

    </style>
<?php } else { ?>
    <style>
        .text-center .editable {
            font-weight: 600;
            color: #000000ba;
        }

        */
    </style>
<?php } ?>
<div id="totprinew"></div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title" style="position:relative;">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12 col-12 float top-left-side" style="border: 1px solid #eee;">
                    <form class="form-inline" id="orderForm" action="<?php echo Yii::app()->request->baseUrl; ?>/order/listdata" method="POST">
                        <div class="form-group">
                            <label for="months">Month</label>
                            <select class="form-select" name="year_month" id="months">
                                <option value="January" <?php if ($month == 'January') echo "selected"; ?>>January</option>
                                <option value="February" <?php if ($month == 'February') echo "selected"; ?>>February</option>
                                <option value="March" <?php if ($month == 'March') echo "selected"; ?>>March</option>
                                <option value="April" <?php if ($month == 'April') echo "selected"; ?>>April</option>
                                <option value="May" <?php if ($month == 'May') echo "selected"; ?>>May</option>
                                <option value="June" <?php if ($month == 'June') echo "selected"; ?>>June</option>
                                <option value="July" <?php if ($month == 'July') echo "selected"; ?>>July</option>
                                <option value="August" <?php if ($month == 'August') echo "selected"; ?>>August</option>
                                <option value="September" <?php if ($month == 'September') echo "selected"; ?>>September</option>
                                <option value="October" <?php if ($month == 'October') echo "selected"; ?>>October</option>
                                <option value="November" <?php if ($month == 'November') echo "selected"; ?>>November</option>
                                <option value="December" <?php if ($month == 'December') echo "selected"; ?>>December</option>
                            </select>
                        </div>
                        <div class="form-group fromtomonth">
                            <label for="months">To</label>
                            <input type="checkbox" name="tocheck" id="tocheck">
                            <select class="form-select" name="year_month_to" id="months_to" style="display: none;">
                                <option value="January" <?php if ($month == 'January') echo "selected"; ?>>January</option>
                                <option value="February" <?php if ($month == 'February') echo "selected"; ?>>February</option>
                                <option value="March" <?php if ($month == 'March') echo "selected"; ?>>March</option>
                                <option value="April" <?php if ($month == 'April') echo "selected"; ?>>April</option>
                                <option value="May" <?php if ($month == 'May') echo "selected"; ?>>May</option>
                                <option value="June" <?php if ($month == 'June') echo "selected"; ?>>June</option>
                                <option value="July" <?php if ($month == 'July') echo "selected"; ?>>July</option>
                                <option value="August" <?php if ($month == 'August') echo "selected"; ?>>August</option>
                                <option value="September" <?php if ($month == 'September') echo "selected"; ?>>September</option>
                                <option value="October" <?php if ($month == 'October') echo "selected"; ?>>October</option>
                                <option value="November" <?php if ($month == 'November') echo "selected"; ?>>November</option>
                                <option value="December" <?php if ($month == 'December') echo "selected"; ?>>December</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="years">Year</label>
                            <select class="form-select" name="year_date" id="years">
                                <?php
                                $currentYear = date("Y");
                                $years = isset($year) ? $year : null; // Assuming you're getting the value from a form

                                for ($year = $currentYear+1; $year >= 2020; $year--) {
                                    $selected = ($year == $years) ? "selected" : "";
                                    echo "<option value=\"$year\" $selected>$year</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" <?php if (isset($ex)) {
                                                        echo "checked";
                                                    } ?> name="ex" id="exid">
                            <label>EX Order</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" <?php if (isset($th)) {
                                                        echo "checked";
                                                    } ?> name="th" id="thid">
                            <label>TH Order</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" <?php if (isset($noquote)) {
                                                        echo "checked";
                                                    } ?> name="noquote">
                            <label>No Quote.</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" <?php if (isset($qb)) {
                                                        echo "checked";
                                                    } ?> name="qb">
                            <label>Invoice Draft</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" <?php if (isset($noinvoice)) {
                                                        echo "checked";
                                                    } ?> name="noinvoice">
                            <label>No Invoice</label>
                        </div>

                        <button type="submit" class="btn btn-primary" id="goButton" style="width: 50px;padding:4px; margin: 0 ;float: right;">GO</button>
                    </form>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-12 hide-columns-sec float">
                    <div class="dropdown-side">
                        <div class="form-group multiSelect">
                            <select id="columnSelector" class="multiSelect_field" data-placeholder="Select Columns to Hide">
                                <option value="1" selected>JOG Code</option>
                                <?php if ($user_group == "1" || $user_group == "99") { ?>
                                    <option value="2" selected>No Quote</option>
                                    <option value="3" selected>QB Draft</option>
                                <?php } ?>
                                <option value="4" selected>Order Name</option>
                                <option value="5" selected>Inv no</option>
                                <option value="6" selected>Sales Rep 1</option>
                                <?php if ($user_group == "1" || $user_group == "99") { ?>
                                    <option value="7" selected>Percentage 1</option>
                                <?php } ?>
                                <option value="8" selected>Sales Rep 2</option>
                                <?php if ($user_group == "1" || $user_group == "99") { ?>
                                    <option value="9" selected>Percentage 2</option>
                                <?php } ?>
                                <option value="10" selected>Online Report</option>
                                <option value="11" selected>Year</option>
                                <option value="12" selected>Code</option>
                                <option value="13" selected>Notes</option>
                                <?php if ($user_group == "1" || $user_group == "99") { ?>
                                    <option value="14" selected>Commission</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="Add-table-btn-side">
                        <?php if ($user_group == "1" || $user_group == "99") { ?>
                            <!-- Multi select table Modal Btn Starts from here  -->
                            <div class="col-xl-1 col-lg-1 col-md-12">
                                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#Add-multiple-table-modal">Add Tables</button>
                            </div>
                        <?php } ?>
                        <!-- Multi select table Modal Btn ends  here  -->
                    </div>
                </div>

            </div>
            <div class="row search-month-year">
                <div class="col-xxl-12 col-lg-3 col-md-6 col-sm-12 col-12 dflex">
                    <div>
                        <h2 class="card-title">Search Order (Any Month/Year)</h2>
                    </div>
                    <div class="header-Search">
                        <form class="form-inline" id="search_value" action="<?php echo Yii::app()->request->baseUrl; ?>/order/listdata" method="POST">
                            <input class="w-100 form-control mr-sm-2" type="search" placeholder="Search" name="searchtbl" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0 " type="submit"><i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-xxl-12 col-lg-3 col-md-6 col-sm-12 col-12 dflex">
                    <div>
                        <h2 class="card-title">Search SalesRep (BY Month/Year)</h2>
                    </div>
                    <div class="header-Search2 header-Search ">
                        <form class="form-inline" id="salesRep" action="<?php echo Yii::app()->request->baseUrl; ?>/order/listdata" method="POST">
                            <select class="form-select w-100" name="salesrep" id="salesRepnamechange">
                                <option value="">search by sales</option>
                                <option value="online store">Online Store</option>
                                <option value="sample">SAMPLE</option>
                                <option value="free">FREE</option>
                                <option value="cancel">CANCEL</option>
                                <option value="remake">REMAKE</option>
                                <option value="Sami Holmes">Sami Holmes</option>
                                <?php
                                $sql_user = "
                                    SELECT * 
                                    FROM `user` 
                                    WHERE 
                                        `user_group_id` = 2 
                                        AND `enable` = 1 
                                        AND `fullname` NOT IN (
                                            'Jim',
                                            'Lucas Trickle',
                                            'Matt Carey',
                                            'Mike Nightingale',
                                            'Shane Hiley',
                                            'Trevor Easthope'
                                        )
                                    ORDER BY fullname ASC;
                                ";
                                $sales_user = Yii::app()->db->createCommand($sql_user)->queryAll();
                                foreach ($sales_user as $user) {
                                    
                                    switch ($user['fullname']) {
                                        case 'Trent Whitcomb':
                                            echo '<option value="JOG/TRENT">JOG/TRENT</option>';
                                            break;
                                        
                                        case 'Dave Kwant':
                                            echo '<option value="JOG/DAVE">JOG/DAVE</option>';
                                            break;                                        
                                        case 'Kristy Whitcomb':
                                            echo '<option value="JOG/KRISTY">JOG/KRISTY</option>';
                                            echo '<option value="JOG/TRENT">JOG/TRENT</option>';
                                            echo '<option value="JOG/JOHN">JOG/JOHN</option>';
                                            break;                                        
                                        default:
                                            echo '<option value="'. $user['fullname'].'">'. $user['fullname'].'</option>';
                                            break;
                                    }
                                ?>                                                                          
                                <?php                            
                                }
                                ?>     
                                <option value="Trent Whitcomb">Trent Whitcomb</option>                           
                            </select>
                            <!-- <select class="form-select w-100" name="salesrep" id="salesRepnamechange">
                                <option value="">search by sales</option>
                                <option value="online store">Online Store</option>
                                <option value="sample">SAMPLE</option>
                                <option value="free">FREE</option>
                                <option value="cancel">CANCEL</option>
                                <option value="remake">REMAKE</option>
                                <option value="adrian_meyers">Adrian Meyers</option>
                                <option value="andrew_toulouse">Andrew Toulouse</option>
                                <option value="alex_angers_goulet">Alex Angers Goulet</option>
                                <option value="bob_hannah">Bob Hannah</option>
                                <option value="carolyn_kwant">Carolyn Kwant</option>
                                <option value="dan_groth">Dan Groth</option>
                                <option value="dana_mcguane">Dana Mcguane</option>
                                <option value="ed_zacharski">Ed Zacharski</option>
                                <option value="gabe_gauthier">Gabe Gauthier</option>
                                <option value="ian_kwant">Ian Kwant</option>
                                <option value="jeff_crenshaw">Jeff Crenshaw</option>
                                <option value="JOG SPORTS">JOG SPORTS</option>                                
                                <option value="JOG/KRISTY">JOG/KRISTY</option>
                                <option value="JOG/TRENT">JOG/TRENT</option>
                                <option value="JOG/JOHN">JOG/JOHN</option>
                                <option value="JOG/DAVE">JOG/DAVE</option>
                                <option value="john_van_groll">John Van Groll</option>
                                <option value="michael_dowling">Michael Dowling</option>
                                <option value="mike_pilon">Mike Pilon</option>
                                <option value="Monica">Monica</option>
                                <option value="nick_kaiser">Nick Kaiser</option>
                                <option value="sami_holmes">Sami Holmes</option>
                                <option value="trent_whitcomb">Trent Whitcomb</option>
                            </select> -->
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-xxl-12 col-lg-3 col-md-6 col-sm-12 col-12 dflex">
                    <!-- <div>
                        <h2 class="card-title">Convert to Quotation (BY SalesRep)</h2>
                    </div>                
                    <div class="header-Search2 header-Search  form-inline"> 
                            <div class="dflex">       
                                <select class="form-select w-100" name="salesrepctoq" id="salesrepctoq">
                                    <option value="">Choose sales</option>
                                    <?php
                                    $user = User::model()->findAllByAttributes(
                                        array('user_group_id' => '2'),
                                        array('order' => 'username ASC') // Sort by username in ascending order
                                    );

                                    foreach ($user as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value->fullname; ?>"><?php echo $value->fullname; ?></option>
                                    <?php
                                    }
                                    ?>                                    
                                </select>
                                <button class="btn btn-outline-success my-2 my-sm-0" onclick="printJOGcoq()"><i class="fa fa-search" aria-hidden="true"></i>
                                </button>   
                            </div>                     
                    </div> -->
                </div>
                <div class="col-xxl-12 col-lg-3 col-md-6 col-sm-12 col-12 dflex">
                    <div class="prnttbl">
                        <button class="btn btn-primary" onclick="copyTable()">Copy</button>
                        <form action="/order/ExportCSV" method="POST">
                            <input type="hidden" class="excelex" name="excelex" value="">
                            <button class="btn btn-danger">CSV</button>
                        </form>
                        <form action="/order/ExportExcel" method="POST" id="expexcel">
                            <input type="hidden" class="excelex" name="excelex" value="">
                            <button class="btn btn-success">Excel</button>
                        </form>
                        <button class="btn btn-info" onclick="printTable()">Print</button>


                    </div>
                </div>

            </div>
        </div>




        <div class="clearfix"></div>

        <div class="x_content">

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 " style="padding: 0;">

                    <div class="">

                        <h5>Order list</h5>
                    </div>


                    <table id="orderTable" class="table table-striped">

                        <thead>
                            <div class="h6 dynamic-selected-month">
                                <?php echo $month; ?>
                            </div>

                            <tr class="bg-dark text-white">
                                <th id="col1" class="jogCodeTH" <?php if ($user_group != "1" || $user_group != "99") { ?> width: 60px; <?php } ?>">JOG Code</th>
                                <th id="col2" class="noCodeTH" style="padding: 5px;">No Quote</th>
                                <th id="col3" class="qbDraftTH" style="padding: 5px;">QB Draft</th>
                                <th id="colType" class="typeTH">Type</th>
                                <?php if ($user_group == "1" || $user_group == "99") { ?>
                                <?php } ?>
                                <th id="col4" class="orderNameTH">Order Name</th>
                                <th id="col5" class="invNoTH">Inv no</th>
                                <th id="col18" class="invsenddate" style="padding-right: 5px;">Link sent </br> by Admin</th>
                                <th id="col19" class="invsenddate" style="padding-left: 5px;">Link sent </br> by Reps</th>
                                <?php if ($user_group == "1" || $user_group == "99") { ?>
                                <?php } ?>
                                <th id="col6" class="salesRepTH1">Sales Rep</th>
                                <th id="col7" class="percentage1TH">%</th>
                                <?php if ($user_group == "1" || $user_group == "99") { ?>
                                <?php } ?>
                                <th id="col8">Sales Rep</th>
                                <th id="col9" class="text-center percentage1TH">%</th>
                                <!-- <th id="col11">Online Report</th> -->
                                <th id="col14" style="padding: 5px;">Comment</th>
                                <?php if ($user_group == "1" || $user_group == "99") { ?>
                                    <?php if ($user_id == "2" || $user_id == "40" || $user_id == "28" || $user_id == "79") { ?>

                                    <?php } ?>
                                    <th id="col15" class="text-center" style="padding: 5px;">Commission</th>
                                    <th id="col16" class="text-center" style="padding: 5px;">Action</th>
                                    <th id="col17" class="text-center" style="padding: 5px;">
                                        Shipment Status
                                    </th>
                                <?php } ?>

                            </tr>
                        </thead>

                    </table>                    
                    <div class="TypeColorBAr">
                        <div class="card">
                            <div class="d-flex">
                                <h6 class="colorUSe">Remake = </h6>
                                <div class="colorCode text-secondary" id="if_Remake">
                                    <h6>RM</h6>
                                </div>
                            </div>
                            <span>|</span>
                            <div class="d-flex">
                                <h6 class="colorUSe">New Order = </h6>
                                <div class="colorCode text-secondary " id="if_NewOrder">
                                    <h6>N</h6>
                                </div>
                            </div>
                            <span>|</span>
                            <div class="d-flex">
                                <h6 class="colorUSe">Cancel = </h6>
                                <div class="colorCode text-secondary" id="if_Cancel">
                                    <h6>CC</h6>
                                </div>
                            </div>
                            <span>|</span>
                            <div class="d-flex">
                                <h6 class="colorUSe">Free = </h6>
                                <div class="colorCode text-secondary" id="if_Free">
                                    <h6>F</h6>
                                </div>
                            </div>
                            <span>|</span>
                            <div class="d-flex">
                                <h6 class="colorUSe">Online = </h6>
                                <div class="colorCode text-secondary" id="if_Online">
                                    <h6>ON</h6>
                                </div>
                            </div>
                            <span>|</span>
                            <div class="d-flex">
                                <h6 class="colorUSe">Sample = </h6>
                                <div class="colorCode text-secondary" id="if_Sample">
                                    <h6>S</h6>
                                </div>
                            </div>
                            <span>|</span>
                            <div class="d-flex">
                                <h6 class="colorUSe">Reorder = </h6>
                                <div class="colorCode text-secondary" id="if_Reorder">
                                    <h6>RO</h6>
                                </div>
                            </div>
                            <span>|</span>
                            <div class="d-flex">
                                <h6 class="colorUSe">Default = </h6>
                                <div class="colorCode text-secondary" id="if_Default">
                                    <h6> </h6>
                                </div>
                            </div>

                        </div>
                    </div>                    
                </div>
            </div>

        </div>
    </div>
</div>

<div id="invpopm"></div>
<div id="invpopsalesDate"></div>
<div id="invpopAdminDate"></div>
<!-- COMMMISOPN Data Modal starts from here -->
<div class="modal fade commission-modal" id="Commission" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="flex-header modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Choose Sales Rep </h4>
            </div>
            <div class="modal-body">
                <div id="salesrapuserbtn"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- upload report Data Modal starts from here -->
<div class="modal fade" id="freebModal" tabindex="-1" role="dialog" aria-labelledby="freebModal1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="flex-header modal-header">
                <div class="d-flex">
                    <h3 class="modal-title" style="float:left;" id="freebModal1"></h3>
                    <button style="float:right;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <form id="upload_sample" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Upload File(*EXCEL OR PDF ONLY)</label>
                        <input type="file" class="form-control" name="files_name" id="exampleInputEmail1" accept="application/pdf,application/vnd.ms-excel">
                        <input type="hidden" id="main_conv_id" name="main_conv_id" required class="form-control">
                        <input type="hidden" id="conv_type" name="conv_type">
                    </div>
                    <div id="note_div">

                    </div>
                    <div class="loaderdiv">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <div id="updataloading" style="display: none;"></div>
                    </div>
                </form>
                <iframe src="" style="display:none;" id="pdf_source" type="frame&amp;vlink=xx&amp;link=xx&amp;css=xxx&amp;bg=xx&amp;bgcolor=xx" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scorlling="yes" width="100%" height="600"></iframe>
                <iframe class="frame_content" id="live_view" style="display:none;" src="" width="100%" height="700" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Add Tables Data Modal starts from here -->
<div class="modal" id="Add-multiple-table-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="flex-header modal-header">
                <h5 class="modal-title">Add Tables Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="insertorder" action="addUpdate" method="POST">
                <div class="modal-body">

                    <table class="table" id="add-multiple-table">
                        <thead>
                            <tr>
                                <th scope="col" class="jCode">JOG Code</th>
                                <th scope="col" class="nQuote">No Quote</th>
                                <th scope="col" class="qDraft">QB Draft</th>
                                <th scope="col" class="orderName">Order Name</th>
                                <th scope="col" class="invNo">Inv no</th>
                                <th scope="col" class="invLinks">Inv Links</th>
                                <th scope="col" class="sRep1">Sales Rep</th>
                                <th scope="col" class="percentage1">Percentage</th>
                                <th scope="col" class="sRep2">Sales Rep</th>
                                <th scope="col" class="percentage2">Percentage</th>
                                <th scope="col" class="month">Month</th>
                                <th scope="col" class="year">Year</th>
                                <th scope="col" class="typeOfCode">Code</th>
                                <th scope="col" class="remark">Comment</th>
                                <th scope="col" class="Action">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" class="jCode" name="jCode[]" value="" required></td>
                                <td><input type="checkbox" class="nQuote" name="nQuote[]" value="true"></td>
                                <td><input type="checkbox" class="qDraft" name="qDraft[]" value="true"></td>
                                <td><input type="text" class="orderName" name="orderName[]"></td>
                                <td><input type="text" class="invNo" name="invNo[]"></td>
                                <td><input type="text" class="invLinks" name="invLinks[]"></td>
                                <td>
                                    <select class="form-select sales_rep_1" name="sRep1[]" id="sRep1">
                                        <?php
                                        foreach ($users as $key => $value) {
                                            $fullname = $value['fullname'];
                                            echo "<option value=\"$fullname\" >$fullname</option>";
                                        }
                                        ?>
                                        <option value="FREE">FREE</option>
                                        <option value="REMAKE">REMAKE</option>
                                        <option value="SAMPLE">SAMPLE</option>
                                        <option value="CANCLE">CANCLE</option>
                                    </select>
                                </td>
                                <td><input type="text" class="percentage1" name="percentage1[]"></td>
                                <td>
                                    <select class="form-select sales_rep_2" name="sRep2[]" id="sRep2">
                                        <?php
                                        foreach ($users as $key => $value) {
                                            $fullname = $value['fullname'];
                                            echo "<option value=\"$fullname\" >$fullname</option>";
                                        }
                                        ?>
                                        <option value="FREE">FREE</option>
                                        <option value="REMAKE">REMAKE</option>
                                        <option value="SAMPLE">SAMPLE</option>
                                        <option value="CANCLE">CANCLE</option>
                                    </select>
                                </td>
                                <td><input type="text" class="percentage2" name="percentage2[]"></td>
                                <td>
                                    <select class="form-select" name="month[]" id="month">
                                        <option value="January" <?php if ($month == 'January') echo "selected"; ?>>January</option>
                                        <option value="February" <?php if ($month == 'February') echo "selected"; ?>>February</option>
                                        <option value="March" <?php if ($month == 'March') echo "selected"; ?>>March</option>
                                        <option value="April" <?php if ($month == 'April') echo "selected"; ?>>April</option>
                                        <option value="May" <?php if ($month == 'May') echo "selected"; ?>>May</option>
                                        <option value="June" <?php if ($month == 'June') echo "selected"; ?>>June</option>
                                        <option value="July" <?php if ($month == 'July') echo "selected"; ?>>July</option>
                                        <option value="August" <?php if ($month == 'August') echo "selected"; ?>>August</option>
                                        <option value="September" <?php if ($month == 'September') echo "selected"; ?>>September</option>
                                        <option value="October" <?php if ($month == 'October') echo "selected"; ?>>October</option>
                                        <option value="November" <?php if ($month == 'November') echo "selected"; ?>>November</option>
                                        <option value="December" <?php if ($month == 'December') echo "selected"; ?>>December</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="year[]" id="year">
                                        <?php
                                        $currentYear = date("Y");

                                        for ($year = $currentYear; $year >= 2003; $year--) {
                                            $selected = ($year == $currentYear) ? "selected" : "";
                                            echo "<option value=\"$year\" $selected>$year</option>";
                                        }
                                        ?>

                                    </select>
                                </td>
                                <td><select name="typeOfCode[]" id="typeOfCode" style="text-transform:uppercase;">
                                        <option value="EX">EX</option>
                                        <option value="TH">TH</option>
                                    </select></td>
                                <td><input type="text" class="remark" name="remark[]"></td>
                                <td class="text-center"><span class=""><i class="fa fa-trash-o secondary-btn"></i></span></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">

                    <a id="addRowBtn" class="btn btn-primary">Add New Row</a>

                    <button type="submit" class="btn btn-success">submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Tables Data Modal ends here-->

<div class="modal fade" id="adminCommentModal" tabindex="-1" role="dialog" aria-labelledby="convNoteModal123" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="flex-header modal-header">
                <div class="d-flex">
                    <h3 class="modal-title" style="float:left;" id="convNoteModal123">Admin Comments</h3>
                    <button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="submit_note_admin">
                    <input type="hidden" value="" name="conv_id" id="conv_id_note_admin">
                    <input type="hidden" value="" name="jog_code" id="jog_code_note_admin">
                    <input type="hidden" value="0" name="is_avail" id="is_avail">
                    <div id="d_admin_comments"></div>
                    <?php
                    if ($user_id == "2" || $user_id == "40" || $user_id == "28" || $user_id == "79" || $user_id == "44") {
                    ?>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Add/Edit:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="admin_comments" id="note_admin_edit"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Add/Edit:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="admin_comments" id="note_admin_edit"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade invlink-modal in" id="salescontoqu" tabindex="-1" role="dialog" aria-labelledby="salescontoqu" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="flex-header modal-header">
                <div class="d-flex">
                    <h3 class="modal-title" style="float:left;" id="convNoteModal123">Convert to Quotation JOG Code</h3>
                    <button type="button" style="float:right;" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <form action="">
                    <div id="salesjogdata"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="exportToExcel()">Export Excel</button>
                        <button type="button" class="btn btn-primary" onclick="sendmailajx()">Send Mail</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- ✅ DataTables Core -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- ✅ Buttons Extension (same version family) -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- ✅ (Optional) JSZip & pdfmake for Excel/PDF export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<!-- Your JavaScript code -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    function exportToExcel() {
        const rows = [
            ["JOG Code"]
        ]; // Add header row

        const checkboxes = document.querySelectorAll('#salesjogdata input[type="checkbox"]');
        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                const itemCode = checkbox.nextElementSibling.innerText;
                rows.push([itemCode]); // Add checked item to the rows array
            }
        });

        // Create a new workbook and add the data
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet(rows);
        XLSX.utils.book_append_sheet(wb, ws, "Checked Data");

        // Export the workbook
        XLSX.writeFile(wb, "CheckedItems.xlsx");
    }

    function sendmailajx() {
        //let salesrepctoq = document.getElementById("salesrepctoq");
        var salesReP = $('select[name="salesrepctoq"]').eq(0).val();

        const rows = [];
        const checkboxes = document.querySelectorAll('#salesjogdata input[type="checkbox"]');
        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                const itemCode = checkbox.nextElementSibling.innerText;
                rows.push(itemCode); // Add checked item to the rows array
            }
        });

        if (confirm('Are you sure you want to Send Mail ?')) {
            $.ajax({
                type: 'POST',
                url: '/order/convtoquote_jog_mail',
                data: {
                    salesReP: salesReP,
                    jog_code: rows
                },
                success: function(response) {
                    // Update the app_comm_percent input field                               

                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    }
</script>

<!-- Your JavaScript code -->
<script>
    $(document).ready(function() {
        $('#tocheck').change(function() {
            if ($(this).is(':checked')) {
                $('#months_to').show();
            } else {
                $('#months_to').hide();
            }
        });
    });


    function addwutnew(dir, orderId, sortid) {
        var modalHtml = '';
        var modalHtml = `            
            <div class="modal fade" id="addwutnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="flex-header modal-header">
                            <h5 class="modal-title">Add Tables Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form id="insertsortrow" action="insertsortrow" method="POST">
                            <div class="modal-body">

                                <table class="table" id="add-multiple-table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="jCode">JOG Code</th>
                                            <th scope="col" class="nQuote">No Quote</th>
                                            <th scope="col" class="qDraft">QB Draft</th>
                                            <th scope="col" class="orderName">Order Name</th>
                                            <th scope="col" class="invNo">Inv no</th>
                                            <th scope="col" class="invLinks">Inv Links</th>
                                            <th scope="col" class="sRep1">Sales Rep</th>
                                            <th scope="col" class="percentage1">Percentage</th>
                                            <th scope="col" class="sRep2">Sales Rep</th>
                                            <th scope="col" class="percentage2">Percentage</th>
                                            <th scope="col" class="month">Month</th>
                                            <th scope="col" class="year">Year</th>
                                            <th scope="col" class="typeOfCode">Code</th>
                                            <th scope="col" class="remark">Comment</th>                                
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="jCode" name="jCode" value="" required=""></td>
                                            <td><input type="checkbox" class="nQuote" name="nQuote" value="true"></td>
                                            <td><input type="checkbox" class="qDraft" name="qDraft" value="true"></td>
                                            <td><input type="text" class="orderName" name="orderName"></td>
                                            <td><input type="text" class="invNo" name="invNo"></td>
                                            <td><input type="text" class="invLinks" name="invLinks"></td>
                                            <td>
                                                <select class="form-select sales_rep_1" name="sRep1" id="sRep1">
                                                    <option value=""></option>
                                                    <option value="Administrator">Administrator</option><option value="Mirza ">Mirza </option><option value="Carolyn Kwant">Carolyn Kwant</option><option value="Matt Carey">Matt Carey</option><option value="Alex Angers Goulet">Alex Angers Goulet</option><option value="Mike Pilon">Mike Pilon</option><option value="Bob Hannah">Bob Hannah</option><option value="Ed Zacharski">Ed Zacharski</option><option value="Brian Kreft">Brian Kreft</option><option value="Chad Damesworth">Chad Damesworth</option><option value="Tanner Taylor">Tanner Taylor</option><option value="Adrian Meyers">Adrian Meyers</option><option value="Dan Groth">Dan Groth</option><option value="John Van Groll">John Van Groll</option><option value="Exclusive Pro">Exclusive Pro</option><option value="Michael Dowling">Michael Dowling</option><option value="Administrator">Administrator</option><option value="Jog Sports">Jog Sports</option><option value="Shane Hiley">Shane Hiley</option><option value="Kristy Whitcomb">Kristy Whitcomb</option><option value="Ian Kwant">Ian Kwant</option><option value="Dana Mcguane">Dana Mcguane</option><option value="Mike Nightingale">Mike Nightingale</option><option value="Scott Whitcomb">Scott Whitcomb</option><option value="Trevor Easthope ">Trevor Easthope </option><option value="Finance">Finance</option><option value="Rung">Rung</option><option value="Kyle Buckhingham">Kyle Buckhingham</option><option value="Lucas Trickle">Lucas Trickle</option><option value="Jim">Jim</option><option value="Kevin Whalen">Kevin Whalen</option><option value="Total Team Sales">Total Team Sales</option><option value="For Sports ">For Sports </option><option value="Eco Pro Shop">Eco Pro Shop</option><option value="Arrow Sports ">Arrow Sports </option><option value="Tom Reese">Tom Reese</option><option value="EJ Arena ">EJ Arena </option><option value="Jerry's Warehouse">Jerry's Warehouse</option><option value="General Sports ">General Sports </option><option value="Five Hole Sports ">Five Hole Sports </option><option value="Bill Keyser">Bill Keyser</option><option value="Erik Lehto">Erik Lehto</option><option value="Trent Whitcomb">Trent Whitcomb</option><option value="Chad O'Neil ">Chad O'Neil </option><option value="Boonya">Boonya</option><option value="Sami Holmes">Sami Holmes</option><option value="Mike Wolfe ">Mike Wolfe </option><option value="Jeff Mielnicki">Jeff Mielnicki</option><option value="Evan Wenkus">Evan Wenkus</option><option value="Liz Roberts">Liz Roberts</option><option value="Amanda Moffatt">Amanda Moffatt</option><option value="Andy">Andy</option><option value="Billy Bixon">Billy Bixon</option>                                        <option value="FREE">FREE</option>
                                                    <option value="REMAKE">REMAKE</option>
                                                    <option value="SAMPLE">SAMPLE</option>
                                                    <option value="CANCLE">CANCLE</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="percentage1" name="percentage1"></td>
                                            <td>
                                                <select class="form-select sales_rep_2" name="sRep2" id="sRep2">
                                                    <option value=""></option>
                                                    <option value="Administrator">Administrator</option>
                                                    <option value="Mirza ">Mirza </option>
                                                    <option value="Carolyn Kwant">Carolyn Kwant</option>
                                                    <option value="Matt Carey">Matt Carey</option>
                                                    <option value="Alex Angers Goulet">Alex Angers Goulet</option>
                                                    <option value="Mike Pilon">Mike Pilon</option>
                                                    <option value="Bob Hannah">Bob Hannah</option>
                                                    <option value="Ed Zacharski">Ed Zacharski</option>
                                                    <option value="Brian Kreft">Brian Kreft</option>
                                                    <option value="Chad Damesworth">Chad Damesworth</option><option value="Tanner Taylor">Tanner Taylor</option><option value="Adrian Meyers">Adrian Meyers</option><option value="Dan Groth">Dan Groth</option><option value="John Van Groll">John Van Groll</option><option value="Exclusive Pro">Exclusive Pro</option><option value="Michael Dowling">Michael Dowling</option><option value="Administrator">Administrator</option><option value="Jog Sports">Jog Sports</option><option value="Shane Hiley">Shane Hiley</option><option value="Kristy Whitcomb">Kristy Whitcomb</option><option value="Ian Kwant">Ian Kwant</option><option value="Dana Mcguane">Dana Mcguane</option><option value="Mike Nightingale">Mike Nightingale</option><option value="Scott Whitcomb">Scott Whitcomb</option><option value="Trevor Easthope ">Trevor Easthope </option><option value="Finance">Finance</option><option value="Rung">Rung</option><option value="Kyle Buckhingham">Kyle Buckhingham</option><option value="Lucas Trickle">Lucas Trickle</option><option value="Jim">Jim</option><option value="Kevin Whalen">Kevin Whalen</option><option value="Total Team Sales">Total Team Sales</option><option value="For Sports ">For Sports </option><option value="Eco Pro Shop">Eco Pro Shop</option><option value="Arrow Sports ">Arrow Sports </option><option value="Tom Reese">Tom Reese</option><option value="EJ Arena ">EJ Arena </option><option value="Jerry's Warehouse">Jerry's Warehouse</option><option value="General Sports ">General Sports </option><option value="Five Hole Sports ">Five Hole Sports </option><option value="Bill Keyser">Bill Keyser</option><option value="Erik Lehto">Erik Lehto</option><option value="Trent Whitcomb">Trent Whitcomb</option><option value="Chad O'Neil ">Chad O'Neil </option><option value="Boonya">Boonya</option><option value="Sami Holmes">Sami Holmes</option><option value="Mike Wolfe ">Mike Wolfe </option><option value="Jeff Mielnicki">Jeff Mielnicki</option><option value="Evan Wenkus">Evan Wenkus</option><option value="Liz Roberts">Liz Roberts</option><option value="Amanda Moffatt">Amanda Moffatt</option><option value="Andy">Andy</option><option value="Billy Bixon">Billy Bixon</option>                                        <option value="FREE">FREE</option>
                                                    <option value="REMAKE">REMAKE</option>
                                                    <option value="SAMPLE">SAMPLE</option>
                                                    <option value="CANCLE">CANCLE</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="percentage2" name="percentage2"></td>
                                            <td>
                                                <select class="form-select" name="month" id="month">
                                                    <option value="January" selected="">January</option>
                                                    <option value="February">February</option>
                                                    <option value="March">March</option>
                                                    <option value="April" >April</option>
                                                    <option value="May">May</option>
                                                    <option value="June">June</option>
                                                    <option value="July">July</option>
                                                    <option value="August">August</option>
                                                    <option value="September">September</option>
                                                    <option value="October">October</option>
                                                    <option value="November">November</option>
                                                    <option value="December">December</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select" name="year" id="year">
                                                <option value="2026" selected="">2026</option>
                                                <option value="2025">2025</option>
                                                <option value="2024" >2024</option>
                                                <option value="2023">2023</option>
                                                <option value="2022">2022</option>
                                                <option value="2021">2021</option>
                                                <option value="2020">2020</option>
                                                <option value="2019">2019</option>
                                                <option value="2018">2018</option>
                                                <option value="2017">2017</option>
                                                <option value="2016">2016</option>
                                                <option value="2015">2015</option>
                                                <option value="2014">2014</option>
                                                <option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option>
                                                </select>
                                            </td>
                                            <td><select name="typeOfCode" id="typeOfCode" style="text-transform:uppercase;">
                                                    <option value="EX">EX</option>
                                                    <option value="TH">TH</option>
                                                </select></td>
                                            <td><input type="text" class="remark" name="remark"></td>                                
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" class="remark" name="oreid" value=${orderId}>
                                <input type="hidden" class="remark" name="sortrowid" value=${sortid}>
                                <input type="hidden" class="remark" name="dir" value=${dir}>
                                <button type="submit" class="btn btn-success">submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
         `;

        // Append the modal HTML to the body
        $('#invpopm').html(modalHtml);

        // Show the modal using jQuery
        // $('#addwutnew').modal('show');
        $(document).ready(function() {
            // Intercept form submission
            var table = $('#orderTable').DataTable();
            $('#insertsortrow').submit(function(event) {
                // Prevent default form submission
                event.preventDefault();

                // Serialize form data
                var formData = $(this).serialize();

                // Send AJAX request
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'), // Get form action attribute value
                    data: formData,
                    success: function(response) {
                        // Handle success response if needed
                        console.log(response);

                        // Assuming response contains the new row data in JSON format
                        var newRowData = [
                            response.jCode || '',
                            response.nQuote ? 'Yes' : 'No',
                            response.qDraft ? 'Yes' : 'No',
                            response.orderName || '',
                            response.invNo || '',
                            response.invLinks || '',
                            response.sRep1 || '',
                            response.percentage1 || '',
                            response.sRep2 || '',
                            response.percentage2 || '',
                            response.month || '',
                            response.year || '',
                            response.typeOfCode || '',
                            response.remark || ''
                        ];

                        var sortid = parseInt(response.sortrowid); // Convert sortrowid to integer
                        var dir = response.dir; // Get direction (up or down)

                        // Add the new row
                        var rowNode = table.row.add(newRowData).draw().node();

                        // Move the new row to the correct position
                        if (dir === 'up') {
                            $(rowNode).insertBefore($('#orderTable tbody tr').eq(sortid - 1));
                        } else {
                            $(rowNode).insertAfter($('#orderTable tbody tr').eq(sortid));
                        }

                        // Optionally, close the modal
                        $('#addwutnew').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        // Handle errors if any
                        console.error(xhr.responseText);
                        // Optionally, display an error message or perform other actions
                    }
                });
            });
        });

    }

    function sendnotify(type, id, jogcode, Sales_Rep_1, Sales_Rep_2) {

        if (type == 'phone') {
            var msg = 'notification ';
        } else {
            var msg = 'Email';
        }
        if (confirm('Are you sure you want to Send ' + msg + ' ?')) {
            $.ajax({
                type: 'POST',
                data: {
                    type: type,
                    id: id,
                    jogcode: jogcode,
                    Sales_Rep_1: Sales_Rep_1,
                    Sales_Rep_2: Sales_Rep_2
                },
                url: 'quote_notify',
                success: function(response) {

                    var response = JSON.parse(response);
                    console.log(response);
                }
            })
        }
    }

    function viewQuotationFinal(qdoc_id, action_from, jog_code_main, conv_id) {

        $('#main_qdoc_id').val(qdoc_id);
        $('#view_doc_id').val(btoa(qdoc_id));
        $('#quote_approve_bar').show();

        $('#d_quote_body').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

        $('#head_selector_app').hide();
        $('#btn_approve').hide();
        $('#btn_reject').hide();
        $('#btn_print').hide();
        $('#btn_save').hide();
        $('#btn_refresh_date').hide();
        $('#btn_comm_rep').hide();
        $('#btn_comm_rep_2').hide();
        //$('#d_quote_below').hide();
        $('#sp_remark').hide();
        if (action_from != "va") {
            $('#note_text').hide();
        } else {
            $('#note_text').show();
        }

        if (qdoc_id == '') {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/order/FindQdocId",
                data: {
                    "jog_code_main": jog_code_main
                },
                success: function(response) {
                    qdoc_id = response;

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "<?php echo Yii::app()->request->baseUrl; ?>/order/OrderShowQuoteView",
                        data: {
                            "qdoc_id": qdoc_id,
                            "action_from": action_from,
                            "jog_code_main": jog_code_main
                        },
                        success: function(resp) {
                            $('#note_text').val(resp.note_text);
                            $('#d_quote_body').html(resp.inner_content);
                            calComm();
                            $('#btn_approve').attr('conv_id', conv_id);
                            $('#quote_history').hide();

                            $('#d_approval_comment').html(window.atob(resp.approval_comment));

                            if (action_from != "va") {
                                $('#d_quote_below').show();
                                $('#sp_remark').show();
                                $('#btn_print').show();
                            }
                            //$('.subnvat').hide();

                            if (action_from == 'va') {
                                $('#btn_reject').show();
                                $('#btn_approve').show();
                                $('#head_selector_app').show();
                                $('#head_selector_app').val(resp.comp_id);
                                $('#note_text').val(resp.note_text);
                                changeQuoteHeadApp();
                            }

                            //alert(resp.history_inner);
                            if (resp.history_inner != "") {
                                $('#quote_history').show();
                                $('#select_history').html(resp.history_inner);
                            }

                            if (resp.show_reject == "yes") {
                                $('#btn_reject').show();
                                $('#sp_remark').show();
                            }
                            if (resp.show_print == "yes") {
                                //if(action_from=="vp"){
                                $('#btn_refresh_date').show();
                                //}

                            }
                            $.ajax({
                                type: 'POST',
                                data: {
                                    doc_id: qdoc_id
                                },
                                url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchSalesNotes',
                                success: function(response) {

                                    var response = JSON.parse(response);
                                    if (response.status == "0") {
                                        $('#notes_modal_div').hide();
                                    } else {
                                        $('#pre_sale_note_modal').html(response.note);
                                        $('#notes_modal_div').show();
                                    }
                                }
                            })

                            // Show commission button after content loads
                            var salesNameComm = $('#quote_sales_name').val();
                            if (salesNameComm) {
                                $('#btn_comm_rep_label').text(salesNameComm + "'s Comm");
                                $('#btn_comm_rep_label_2').text(salesNameComm + "'s Comm");
                                $('#btn_comm_rep').show();
                                $('#btn_comm_rep_2').show();
                            }
                            recalcCommTotal();

                        }
                    });

                }
            });
        } else {

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/order/OrderShowQuoteView",
                data: {
                    "qdoc_id": qdoc_id,
                    "action_from": action_from,
                    "jog_code_main": jog_code_main
                },
                success: function(resp) {
                    $('#note_text').val(resp.note_text);
                    $('#d_quote_body').html(resp.inner_content);
                    calComm();
                    $('#btn_approve').attr('conv_id', conv_id);
                    $('#quote_history').hide();

                    $('#d_approval_comment').html(window.atob(resp.approval_comment));

                    if (action_from != "va") {
                        $('#d_quote_below').show();
                        $('#sp_remark').show();
                        $('#btn_print').show();
                    }
                    //$('.subnvat').hide();

                    if (action_from == 'va') {
                        $('#btn_reject').show();
                        $('#btn_approve').show();
                        $('#head_selector_app').show();
                        $('#head_selector_app').val(resp.comp_id);
                        $('#note_text').val(resp.note_text);
                        changeQuoteHeadApp();
                    }

                    //alert(resp.history_inner);
                    if (resp.history_inner != "") {
                        $('#quote_history').show();
                        $('#select_history').html(resp.history_inner);
                    }

                    if (resp.show_reject == "yes") {
                        $('#btn_reject').show();
                        $('#sp_remark').show();
                    }
                    if (resp.show_print == "yes") {
                        //if(action_from=="vp"){
                        $('#btn_refresh_date').show();
                        //}

                    }
                    $.ajax({
                        type: 'POST',
                        data: {
                            doc_id: qdoc_id
                        },
                        url: '<?php echo Yii::app()->request->baseUrl; ?>/quotation/fetchSalesNotes',
                        success: function(response) {

                            var response = JSON.parse(response);
                            if (response.status == "0") {
                                $('#notes_modal_div').hide();
                            } else {
                                $('#pre_sale_note_modal').html(response.note);
                                $('#notes_modal_div').show();
                            }
                        }
                    })

                    // Show commission button after content loads
                    var salesNameComm2 = $('#quote_sales_name').val();
                    if (salesNameComm2) {
                        $('#btn_comm_rep_label').text(salesNameComm2 + "'s Comm");
                        $('#btn_comm_rep_label_2').text(salesNameComm2 + "'s Comm");
                        $('#btn_comm_rep').show();
                        $('#btn_comm_rep_2').show();
                    }
                    recalcCommTotal();

                }
            });
        }

    }
</script>
<script>
    jQuery(function() {
        jQuery('.multiSelect').each(function(e) {
            var self = jQuery(this);
            var field = self.find('.multiSelect_field');
            var fieldOption = field.find('option');
            var placeholder = field.attr('data-placeholder');

            field.hide().after(`<div class="multiSelect_dropdown"></div>
                        <span class="multiSelect_placeholder">` + placeholder + `</span>
                        <ul class="multiSelect_list"></ul>
                        <span class="multiSelect_arrow"></span>`);

            fieldOption.each(function(e) {
                jQuery('.multiSelect_list').append(`<li class="multiSelect_option" data-value="` + jQuery(this).val() + `">
                                            <a class="multiSelect_text">` + jQuery(this).text() + `</a>
                                          </li>`);
            });

            var dropdown = self.find('.multiSelect_dropdown');
            var list = self.find('.multiSelect_list');
            var option = self.find('.multiSelect_option');
            var optionText = self.find('.multiSelect_text');

            dropdown.attr('data-multiple', 'true');
            list.css('top', dropdown.height() + 5);

            option.click(function(e) {
                var self = jQuery(this);

                e.stopPropagation();
                self.addClass('-selected');
                field.find('option:contains(' + self.children().text() + ')').prop('selected', true);
                dropdown.append(function(e) {
                    return jQuery('<span class="multiSelect_choice" data-id="' + self.data('value') + '">' + self.children().text() + '<i class="fa fa-close multiSelect_deselect -iconX"></i><use href="#iconX"></use></span>').click(function(e) {
                        var self = jQuery(this);
                        e.stopPropagation();
                        self.remove();

                        var chosice = self.data('id');
                        $('#orderTable th:nth-child(' + chosice + '), #orderTable td:nth-child(' + chosice + ')').toggle();

                        list.find('.multiSelect_option:contains(' + self.text() + ')').removeClass('-selected');
                        list.css('top', dropdown.height() + 5).find('.multiSelect_noselections').remove();
                        field.find('option:contains(' + self.text() + ')').prop('selected', false);
                        if (dropdown.children(':visible').length === 0) {
                            dropdown.removeClass('-hasValue');
                        }
                    });
                }).addClass('-hasValue');
                list.css('top', dropdown.height() + 5);
                if (!option.not('.-selected').length) {
                    list.append('<h5 class="multiSelect_noselections">No Selections</h5>');
                }
            });

            dropdown.click(function(e) {
                e.stopPropagation();
                e.preventDefault();
                dropdown.toggleClass('-open');
                list.toggleClass('-open').scrollTop(0).css('top', dropdown.height() + 5);
            });

            jQuery(document).on('click touch', function(e) {
                if (dropdown.hasClass('-open')) {
                    dropdown.toggleClass('-open');
                    list.removeClass('-open');
                }
            });
        });
    });
</script>

<script>
    function printJOGcoq() {
        //let salesrepctoq = document.getElementById("salesrepctoq");
        var salesReP = $('select[name="salesrepctoq"]').eq(0).val();
        $('#salescontoqu').modal('show');
        $('#salesjogdata').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i>Loading...');

        $.ajax({
            type: 'POST',
            url: '/order/getcovtoqoujog',
            data: {
                salesReP: salesReP
            },
            success: function(response) {
                // Update the app_comm_percent input field                
                $('#salesjogdata').html(response);

            },
            error: function(error) {
                console.error('Error:', error);
            }
        });

    }

    function formsplit(id) {
        $("#formsplite" + id + "").toggle();
    }

    function submitForm(qdoci_id) {
        let form = document.getElementsByClassName("form__submit");
        event.preventDefault();

        var salesRep1 = $('select[name="sales_rep_1' + qdoci_id + '"]').eq(0).val();
        var salesRep2 = $('select[name="sales_rep_2' + qdoci_id + '"]').eq(0).val();
        var percent1 = $('input[name="split_comm_percent_1' + qdoci_id + '"]').val();
        var percent2 = $('input[name="split_comm_percent_2' + qdoci_id + '"]').val();


        // Calculate total percentage
        var totalPercent = parseInt(percent1) + parseInt(percent2);

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->request->baseUrl; ?>/quoteEstimate/Splitcomm", // Replace with your server endpoint
            data: {
                sales_rep_1: salesRep1,
                sales_rep_2: salesRep2,
                split_comm_percent1: percent1,
                split_comm_percent2: percent2,
                qdoci_id: qdoci_id
            },
            success: function(response) {
                // Update the app_comm_percent input field
                $('#comm_percent_app' + qdoci_id + '').val(totalPercent);
                console.log(response); // Log the response for debugging
                calComm();
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }

    function calComm() {

        var comm_total = 0.0;
        $('.qdoci_id_app').each(function() {
            var row_id = $(this).val();

            var tmp_amount = parseFloat($('#tmp_amount' + row_id).val()) || 0;
            var comm_percent_input = $('#comm_percent_app' + row_id);
            var comm_val;

            if (tmp_amount < 800) {
                // Amount under $800: show 0 for Comm. display only, do not reset the input
                comm_val = 0;
            } else {
                var comm_percent = comm_percent_input.val();
                comm_val = (comm_percent / 100) * tmp_amount;
                comm_total += comm_val;
            }

            $('#comm_val_app' + row_id).html(comm_val.toFixed(2));
        });

        $('#td_comm_total').html(comm_total.toFixed(2));

    }

    // $(document).ready(function() {
    //     $('#orderTable').DataTable({
    //         dom: 'lBfrtip', // Specify the placement of the buttons
    //         buttons: [
    //             'copy', 'csv', 'excel', 'print'
    //         ],
    //         pageLength: 25
    //     });
    // });
</script>

<script>

    var orderTable = null;
    var isFirstLoad = true;

    $(document).ready(function() {
        if (!$.fn.DataTable.isDataTable('#orderTable')) {
            orderTable = $('#orderTable').DataTable({
                ajax: {
                    url: '<?php echo Yii::app()->request->baseUrl; ?>/order/listdata',
                    type: 'POST',
                    data: function(d) {
                        var formData = $('#orderForm, #search_value, #salesRep').serializeArray();
                        formData.forEach(function(item) {
                            d[item.name] = item.value;
                        });
                    }
                },
                serverSide: true,
                processing: true,
                deferRender: true,
                ordering: false,
                pageLength: 100,                
                language: {
                    search: '_INPUT_',
                    searchPlaceholder: 'Search...'
                },
                columnDefs: [{
                    orderable: false,
                    targets: '_all'
                }],
                drawCallback: function() {
                },
                initComplete: function() {
                    // After DataTable is fully loaded, allow reloads
                    isFirstLoad = false;
                }
            });
            console.log('DataTable initialized (first time).');
        } else {
            orderTable = $('#orderTable').DataTable();
        }

        // Handle all form submissions
        $('#orderForm, #search_value, #salesRep').off('submit.myDT').on('submit.myDT', function(e) {
            e.preventDefault();
            if (!isFirstLoad) {
                console.log('orderTable.ajax.reload() called');
                orderTable.ajax.reload(null, false);
            }
        });
    });
    // Function to initialize or reinitialize DataTable
    // function initializeDataTable() {
    //     // Check if DataTable instance already exists
    //     if ($.fn.DataTable.isDataTable('#orderTable')) {
    //         // Destroy existing DataTable instance
    //         $('#orderTable').DataTable().destroy();
    //     }

    //     // Initialize DataTable with AJAX configuration
    //     new DataTable('#orderTable', {
    //         ajax: {
    //             url: '/order/listdata', // URL to your server-side script
    //             type: 'POST', // Use POST method for submitting form data
    //             data: function(d) {
    //                 // Serialize form data and send it with the AJAX request
    //                 var formData = $('#orderForm, #search_value, #salesRep').serializeArray();
    //                 formData.forEach(function(item) {
    //                     d[item.name] = item.value;
    //                 });
    //             }
    //         },
    //         processing: true,
    //         serverSide: true,
    //         pageLength: 100,
    //         language: {
    //             search: '_INPUT_',
    //             searchPlaceholder: 'Search...'
    //         },
    //         columnDefs: [{
    //                 orderable: false,
    //                 targets: '_all'
    //             } // Disable sorting on all columns
    //         ],
    //         drawCallback: function(settings) {
    //             // Check the state of checkboxes on the current page
    //             var allChecked = true;
    //             $('#orderTable .forselectall').each(function() {
    //                 if (!$(this).is(':checked')) {
    //                     allChecked = false;
    //                 }
    //             });
    //             $('#selectallapprove').prop('checked', allChecked);
    //         }
    //     });
    // }

    // // Call the function to initialize DataTable when the page is loaded
    // $(document).ready(function() {
    //     initializeDataTable();
    // });

    // // Event listener for form submission
    // $('#orderForm').submit(function(event) {
    //     event.preventDefault(); // Prevent form submission

    //     // Call the function to initialize or reinitialize DataTable
    //     initializeDataTable();
    // });

    // $('#search_value').submit(function(event) {
    //     event.preventDefault(); // Prevent form submission

    //     // Call the function to initialize or reinitialize DataTable
    //     initializeDataTable();
    // });

    // $('#salesRep').submit(function(event) {
    //     event.preventDefault(); // Prevent form submission

    //     // Call the function to initialize or reinitialize DataTable
    //     initializeDataTable();
    // });


    // function fetchData() {
    //     return new Promise((resolve, reject) => {
    //         // Perform AJAX request to fetch data
    //         $.ajax({
    //             url: 'Listdata',
    //             method: 'GET',
    //             success: function(data) {
    //                 resolve(data); // Resolve the promise with the fetched data
    //             },
    //             error: function(xhr, status, error) {
    //                 reject(error); // Reject the promise if there's an error
    //             }
    //         });
    //     });
    // }

    // async function populateTable() {
    //     try {
    //         const foods = await fetchData(); // Wait for the data to be fetched
    //         const table = document.querySelector('#food tbody');
    //         foods.forEach(food => {
    //             const row = document.createElement('tr');
    //             const fatClass = `row${food.id}`;
    //             row.setAttribute('class', fatClass);
    //             row.innerHTML = `
    //                 <td data-col="1"><a data-toggle="modal" data-target="#quoteDocModal" onclick="viewQuotationFinal('${food.qdoci_id}','vp','${food.JOG_Code}','${food.conv_id}');"> ${food.JOG_Code}</a> </td>
    //                 <td> ${food.No_Quote} </td>
    //                 <td> ${food.Order_Name} </td>
    //                 <td> ${food.QB_Draft} </td>
    //             `;
    //             table.appendChild(row);
    //         });
    //     } catch (error) {
    //         console.error('Error fetching or populating data:', error);
    //     }
    // }

    // // Call the function to populate the table with data
    // populateTable();
    // $(document).ready(function () {
    //      var table = $('#food').DataTable();
    // });


    // create array of above table
    //   const foods = [
    //      { name: "Bread", calories: 100, fat: 10, carbs: 20 },
    //      { name: "Butter", calories: 50, fat: 5, carbs: 10 },
    //      { name: "Avocado", calories: 500, fat: 50, carbs: 60 },
    //      { name: "Apple", calories: 600, fat: 60, carbs: 70 },
    //      { name: "Orange", calories: 700, fat: 70, carbs: 80 },
    //      { name: "Watermelon", calories: 800, fat: 80, carbs: 90 },
    //      { name: "Strawberry", calories: 900, fat: 90, carbs: 100 },
    //      { name: "Blueberry", calories: 1000, fat: 100, carbs: 110 },
    //      { name: "Raspberry", calories: 1200, fat: 120, carbs: 130 },
    //      { name: "Cherry", calories: 1300, fat: 130, carbs: 140 },
    //      { name: "Plum", calories: 1400, fat: 140, carbs: 150 },
    //      { name: "Peach", calories: 1500, fat: 150, carbs: 160 },
    //      { name: "Pear", calories: 1600, fat: 160, carbs: 170 },
    //      { name: "Grapes", calories: 1700, fat: 170, carbs: 180 },
    //      { name: "Banana", calories: 1800, fat: 180, carbs: 190 },
    //      { name: "Pineapple", calories: 1900, fat: 190, carbs: 200 },
    //      { name: "Mango", calories: 2000, fat: 200, carbs: 210 },
    //      { name: "Papaya", calories: 2100, fat: 210, carbs: 220 },
    //      { name: "Kiwi", calories: 2200, fat: 220, carbs: 230 },
    //      { name: "Grapefruit", calories: 2300, fat: 230, carbs: 240 },
    //      { name: "Lemon", calories: 2400, fat: 240, carbs: 250 },
    //      { name: "Lime", calories: 2500, fat: 250, carbs: 260 },
    //   ]
    // accessing the table and adding data
    //   const table = document.querySelector('#food tbody')
    //   foods.forEach(food => {
    //      const row = document.createElement('tr')
    //      const fatClass = `row${food.fat}`; // Generating class name based on fat value
    //      row.setAttribute('class', fatClass);
    //      row.innerHTML = `
    //      <td data-col="1"> ${food.name} </td>
    //      <td> ${food.calories} </td>
    //      <td> ${food.fat} </td>
    //      <td> ${food.carbs} </td>
    //      `
    //      table.appendChild(row)
    //   })
</script>


<script>
    $(document).ready(function() {
        // Listen for changes in the select element
        $('.multiSelect_option').click(function() {
            var value = $(this).data('value');

            // Toggle visibility of the corresponding column
            $('#orderTable th:nth-child(' + value + '), #orderTable td:nth-child(' + value + ')').toggle();
        });
        $('.multiSelect_choice').click(function() {

            var chosice = $(this).data('id');
            console.log(chosice);
            // Toggle visibility of the corresponding column
            $('#orderTable th:nth-child(' + value + '), #orderTable td:nth-child(' + value + ')').toggle();
        });

    });

    $('#orderTable').on('mouseenter', '.innerBox ', function() {
        $(this).closest('.TypeColorFetch').find('.ShowTypeColorPallet').show();
    });
    $('#orderTable').on('mouseleave', '.TypeColorFetch', function() {
        $(this).closest('.TypeColorFetch').find('.ShowTypeColorPallet').hide();
    });

    $('#orderTable').on('click', '.innerBox', function() {
        // Remove the 'defaultActive' class from all innerBoxes within all .TypeColorFetch elements
        $('.TypeColorFetch .innerBox').removeClass('defaultActive');
        $(this).addClass('defaultActive');

        $(this).closest('.TypeColorFetch').find('#if_click').attr('id', selectedId).html($(this).html());
        var selectedId = $(this).attr('id');
        var nm = $(this).data('nm');
        var id = $(this).data('id');
        console.log(selectedId);
        $(this).closest('.TypeColorFetch').find('.ShowTypeColorPallet').hide();
        $(this).closest('.TypeColorFetch').find('#if_click').attr('class', 'innerBox ' + nm + '').html($(this).html());

        $.ajax({
            type: 'POST',
            url: 'UpdatList', // specify the URL to handle the update
            data: {
                nm: nm,
                typechange: 'TypeColorFetch',
                orderId: id
            },
            success: function(response) {
                // Handle success response if needed
            },
            error: function(xhr, status, error) {
                // Handle errors if any
                console.error(xhr.responseText);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {

        // 1 ----------------------------

        // Color Pallet in order Table
        // $('#orderTable').on('click', '.innerBox', function() {
        //     var selectedId = $(this).attr('id');
        //     $('#if_click').attr('id', selectedId).html($(this).html());
        // });

        // 2  ---------------------------

        // $('#orderTable').on('click', '.innerBox', function() {
        //     // Remove the 'defaultActive' class from all innerBoxes within all .TypeColorFetch elements
        //     $('.TypeColorFetch .innerBox').removeClass('defaultActive');

        //     // Add the 'defaultActive' class to the clicked innerBox
        //     $(this).addClass('defaultActive');

        //     // Update #if_click within the same .TypeColorFetch with the clicked innerBox's color and content
        //     var selectedId = $(this).attr('id');
        //     $(this).closest('.TypeColorFetch').find('#if_click').attr('id', selectedId).html($(this).html());
        // });





        // Event delegation for sales_rep_2 dropdown
        $('#orderTable').on('change', '.sales_rep_2', function(event) {
            var initialValue = $(this).data('initial');
            handleSalesRepChange($(this), 'sales_rep_2', event, initialValue);
        });

        // Event delegation for sales_rep_1 dropdown
        $('#orderTable').on('change', '.sales_rep_1', function(event) {
            var initialValue = $(this).data('initial');
            handleSalesRepChange($(this), 'sales_rep_1', event, initialValue);
        });

        function handleSalesRepChange(dropdown, salesRepClass, event, initialValue) {
            var selectedSalesRep = dropdown.val();
            var selectedOption = dropdown.find('option:selected');
            var orderid = selectedOption.data('id');

            // Ask for confirmation
            if (!confirm('Are you sure you want to update the sales representative?')) {
                console.log("Select: User canceled update.");
                dropdown.val(initialValue); // Reset dropdown to its initial value                
                return;
            }
            // Ajax call to update the value
            $.ajax({
                type: 'POST',
                url: 'UpdatList', // specify the URL to handle the update
                data: {
                    sales_rep: selectedSalesRep,
                    order_id: orderid,
                    sales_rep_class: salesRepClass // Include sales representative class
                },
                success: function(response) {
                    // Handle success response if needed
                    var parentTr = dropdown.closest('tr');
                    var nonCommReps = ["Carolyn Kwant", "Jog Sports", "REMAKE", "SAMPLE", "CANCEL", "FREE"];
                    if (nonCommReps.indexOf(selectedSalesRep) === -1) {
                        parentTr.find('.commdiv').removeClass("hidden");
                        parentTr.find('.commcar').addClass("hidden");
                    } else {
                        parentTr.find('.commdiv').addClass("hidden");
                        parentTr.find('.commcar').removeClass("hidden");
                    }

                    // Fetch and auto-populate the commission % for the selected sales rep
                    var percentField = (salesRepClass === 'sales_rep_1') ? 'percentage_1' : 'percentage_2';
                    var percentSpan = dropdown.closest('td').next('td').find('.editable');

                    $.ajax({
                        type: 'POST',
                        url: 'GetCommissionRate',
                        data: { sales_rep_name: selectedSalesRep },
                        success: function(rateResponse) {
                            try {
                                var rateData = (typeof rateResponse === 'string') ? JSON.parse(rateResponse) : rateResponse;
                                var commRate = rateData.commission_type;
                                // Default to 0 if not found or empty
                                if (commRate === null || commRate === undefined || commRate === '') {
                                    commRate = 0;
                                }
                                // Update the % span in the UI
                                percentSpan.text(commRate);
                                // Persist the commission rate to the database
                                $.ajax({
                                    type: 'POST',
                                    url: 'UpdatList',
                                    data: { field: percentField, value: commRate, orderid: orderid }
                                });
                            } catch(e) {
                                console.error('Error parsing commission rate response', e);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Failed to fetch commission rate', xhr.responseText);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors if any
                    console.error(xhr.responseText);
                }
            });

        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#orderTable').on('dblclick', '.editable-cell', function() {
            var cell = $(this);
            var fieldValue = cell.find('.editable').text();
            var field = cell.find('.editable').data('field');
            var id = cell.find('.editable').data('id');
            var inputField = $('<input class="form-control" type="text">');
            inputField.val(fieldValue);
            cell.html(inputField);
            inputField.focus(); // Focus the input field

            // Save changes on blur or Enter key press
            inputField.blur(function() {
                saveChanges(cell, field, inputField.val(), id);
            });
            inputField.keyup(function(event) {
                if (event.keyCode === 13) { // Enter key pressed
                    saveChanges(cell, field, inputField.val(), id);
                }
            });
        });

        function saveChanges(cell, field, value, id) {
            // Update the corresponding span element with the new value
            cell.html('<span class="editable" data-id="' + id + '" data-field="' + field + '">' + value + '</span>');

            $.ajax({
                type: 'POST',
                url: 'UpdatList',
                data: {
                    field: field,
                    value: value,
                    orderid: id,
                },
                success: function(response) {
                    // Handle success response if needed
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle errors if any
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>

<script>
    $(document).ready(function() {
        //Show pencil icon on hover using event delegation
        $('#orderTable').on('mouseenter', '.invlink', function() {
            $(this).find('.edit-icon').show();
        });

        $('#orderTable').on('mouseleave', '.invlink', function() {
            $(this).find('.edit-icon').hide();
        });
    });
</script>



<script>
    $(document).ready(function() {
        // Function to add new row
        $("#addRowBtn").on("click", function() {
            var newRow = `
                <tr>
                    <td><input type="text" class="jCode" name="jCode[]" value="" required></td>
                    <td><input type="checkbox" class="nQuote" name="nQuote[]"></td>
                    <td><input type="checkbox" class="qDraft" name="qDraft[]"></td>
                    <td><input type="text" class="orderName" name="orderName[]"></td>
                    <td><input type="text" class="invNo" name="invNo[]"></td>
                    <td><input type="text" class="invLinks" name="invLinks[]"></td>
                    <td>                        
                        <select class="form-select sales_rep_1" name="sRep1[]">
                            <?php
                            foreach ($users as $key => $value) {
                                $fullname = $value['fullname'];
                                echo "<option value=\"$fullname\" >$fullname</option>";
                            }
                            ?>
                            <option value="FREE" >FREE</option>
                            <option value="REMAKE" >REMAKE</option>
                            <option value="SAMPLE" >SAMPLE</option>
                            <option value="CANCEL" >CANCEL</option>
                        </select>
                    </td>
                    <td><input type="text" class="percentage1" name="percentage1[]"></td>
                    <td>
                        <select class="form-select sales_rep_2" name="sRep2[]">
                            <?php
                            foreach ($users as $key => $value) {
                                $fullname = $value['fullname'];
                                echo "<option value=\"$fullname\" >$fullname</option>";
                            }
                            ?>
                            <option value="FREE" >FREE</option>
                            <option value="REMAKE" >REMAKE</option>
                            <option value="SAMPLE" >SAMPLE</option>
                            <option value="CANCEL" >CANCEL</option>
                        </select>
                    </td>
                    <td><input type="text" class="percentage2" name="percentage2[]"></td>
                    <td>
                        <select class="form-select" name="month[]">
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" name="year[]">
                            <?php
                            $currentYear = date("Y");

                            for ($year = $currentYear; $year >= 2003; $year--) {
                                $selected = ($year == $currentYear) ? "selected" : "";
                                echo "<option value=\"$year\" $selected>$year</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="typeOfCode[]" style="text-transform:uppercase;">
                            <option value="EX">EX</option>
                            <option value="TH">TH</option>
                        </select>
                    </td>
                    <td><input type="text" class="remark" name="remark[]" ></td>
                    <td class="text-center"><span class="removeRowBtn"><i class="fa fa-trash-o delete-btn"></i></span></td>
                </tr>`;
            $("#add-multiple-table tbody").append(newRow);
        });
    });
</script>


<script>
    $(document).ready(function() {
        // Intercept form submission
        $('#insertorder').submit(function(event) {
            // Prevent default form submission
            event.preventDefault();

            // Serialize form data
            var formData = $(this).serialize();

            // Send AJAX request
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'), // Get form action attribute value
                data: formData,
                success: function(response) {
                    // Handle success response if needed
                    console.log(response);
                    location.reload(true);
                    // Optionally, display a success message or perform other actions
                },
                error: function(xhr, status, error) {
                    // Handle errors if any
                    console.error(xhr.responseText);
                    // Optionally, display an error message or perform other actions
                }
            });
        });
    });


    $(document).ready(function() {
        // Listen for changes in the select element       

        $(document).on('click', '.removeRowBtn', function() {
            $(this).closest("tr").remove();
        });
    });
</script>
<!-- js for multi select table starts ends here  -->
<script>
    $(document).ready(function() {
        $('#orderTable').on('change', '.checkbox', function(event) {
            var id = $(this).attr('id').split('_')[2]; // Extracting the order ID
            var fieldName = $(this).attr('id').split('_')[0]; // Extracting the field name (No_Quote or QB_Draft)
            var value = $(this).is(':checked') ? 1 : 0; // Converting checkbox state to 1 (checked) or 0 (unchecked)

            $.ajax({
                type: 'POST',
                url: 'UpdatList', // Replace with your PHP file to handle the update
                data: {
                    id: id,
                    field: fieldName,
                    value: value
                },
                success: function(response) {
                    if (fieldName == 'no' && value == 1) {
                        $('.no_quote_' + id + '').addClass("redtd");
                    }
                    if (fieldName == 'no' && value == 0) {
                        $('.no_quote_' + id + '').removeClass("redtd");
                    }
                    // Handle success response if needed

                    if (fieldName == 'qb' && value == 1) {
                        $('.qb_draft_' + id + '').addClass("bluetd");
                    }
                    if (fieldName == 'qb' && value == 0) {
                        $('.qb_draft_' + id + '').removeClass("bluetd");
                    }
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle error response if needed
                    console.error(xhr.responseText);
                }
            });


            // Send AJAX request to update the data

        });

    });

    $(document).ready(function() {
        $('#orderTable').on('click', '.removerowtb', function(event) {
            var $this = $(this); // Store a reference to $(this) in a variable

            var id = $this.data('id');
            var field = $this.data('field');

            // Get the data-id attribute value
            if (confirm('Are you sure you want to delete?')) {
                // Send AJAX request to delete the row
                $.ajax({
                    type: 'POST',
                    url: 'UpdatList', // Replace with your PHP file to handle the deletion
                    data: {
                        id: id,
                        field: field
                    },
                    context: $this, // Pass the reference of $(this) to the success callback
                    success: function(response) {
                        // Remove the parent <tr> element from the DOM
                        this.closest('tr').remove();
                        // Handle success response if needed
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response if needed
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });


    function invcpopup(orderId, invno, invlink) {
        var modalHtml = '';
        var modalHtml = `
            <div class="modal fade invlink-modal" id="invlink" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="flex-header modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Edit invoice details</h4>
                        </div>
                        <div class="modal-body">
                            <form class="updateinv" action="UpdatList" method="POST">
                            <div style="color: #F00; font-size: 14px; text-align: center; width: 100%; padding: 0px; margin:0px;">Enter Complete Link to the Invoice Link.* Use "," for separate the Invoice Links. <br>The invoice link can't be greater than the invoice number. </div>
                                <div class="form-group">
                                    <input type="hidden" name="orderid" class="form-control" value="${orderId}">
                                    <label for="exampleInputEmail1">Invoice Number</label>
                                    <input type="text" name="invname" class="form-control" value="${invno}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Invoice Link</label>
                                    <input type="text" name="invlink" class="form-control" value="${invlink}">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Append the modal HTML to the body
        $('#invpopm').html(modalHtml);

        // Show the modal using jQuery
        $('#invlink').modal('show');

        $('.updateinv').submit(function(event) {
            // Prevent default form submission
            event.preventDefault();

            // Serialize form data
            var formData = $(this).serialize();
            var orderId = $(this).find('input[name="orderid"]').val();
            var invname = $(this).find('input[name="invname"]').val();
            var invlink = $(this).find('input[name="invlink"]').val();

            var invnameArray = invname.split(',');
            var invlinkArray = invlink.split(',');

            // // Check if invoice link array is greater than invoice name array
            // if (invlinkArray.length != invnameArray.length || invname == '' || invlink == '') {
            //     alert("Invoice number and invoice link should be equal");
            //     return false; // Prevent form submission
            // }

            // Send AJAX request
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'), // Get form action attribute value
                data: formData,
                success: function(response) {
                    // Handle success response if needed
                    console.log(response);
                    $('#invlink').modal('hide');

                    var htmlinv = '';
                    invnameArray.forEach(function(inv_no, index) {
                        if (invlinkArray[index]) {
                            htmlinv += "<a href='" + invlinkArray[index].trim() + "' target='_blank'><u>" + inv_no.trim() + "</u></a><br>";
                        } else {
                            htmlinv += "<span>" + inv_no.trim() + "</span><br>";
                        }
                    });

                    // Update the invoice title element with the generated HTML
                    $('.invtital' + orderId).html(htmlinv);

                    // Set initial value for onclick attribute
                    document.getElementById("invlinkatt" + orderId + "").setAttribute("onclick", "invcpopup('" + orderId + "', '" + invname + "', '" + invlink + "')");

                    //location.reload(true);
                    // Optionally, display a success message or perform other actions
                },
                error: function(xhr, status, error) {
                    // Handle errors if any
                    console.error(xhr.responseText);
                    // Optionally, display an error message or perform other actions
                }
            });
        });

    }

    function invSalesRep(orderId, inv_sales_date, totalarray) {
        // Split the comma-separated dates into an array
        const dates = inv_sales_date.split(',');

        // Generate HTML for each input field based on totalarray length
        let dateInputsHTML = '';
        for (let i = 0; i < totalarray; i++) {
            const dateValue = i < dates.length ? dates[i] : '';
            dateInputsHTML += `
                <input type="date" name="inv_sales_date" class="form-control" value="${dateValue}">
            `;
        }

        var modalHtml = `
            <div class="modal fade invlink-modal" id="invSalesRdate" tabindex="-1" role="dialog">
                <div class="modal-dialog" style="max-width:40% !important">
                    <div class="modal-content">
                        <div class="flex-header modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Add Sales Invoice Date</h4>
                        </div>
                        <div class="modal-body">
                            <form class="UpdatListSalesdate" action="UpdatList" method="POST">                            
                                <div class="form-group">
                                    <input type="hidden" name="orderid" class="form-control" value="${orderId}">
                                    <label for="exampleInputEmail1">Invoice date</label>
                                    ${dateInputsHTML} <!-- Dynamically generated inputs -->
                                </div>  
                            
                                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    
                        
                    </div>
                </div>
            </div>
        `;

        // Append the modal HTML to the body
        $('#invpopsalesDate').html(modalHtml);

        // Show the modal using jQuery
        $('#invSalesRdate').modal('show');

        $('.UpdatListSalesdate').submit(function(event) {
            event.preventDefault();

            // Collect all input values into an array
            const invDates = $(this).find('input[name="inv_sales_date"]')
                .map(function() {
                    return $(this).val().trim(); // Trim whitespace
                })
                .get() // Convert to array
                .join(','); // Join into comma-separated string

            const orderId = $(this).find('input[name="orderid"]').val();

            // Prepare data for submission
            const formData = {
                orderid: orderId,
                inv_sales_date: invDates // Send as comma-separated string
            };

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    console.log(response);
                    $('#invSalesRdate').modal('hide');

                    // Split the dates for UI display
                    const invnameArray = invDates.split(',');
                    let htmlinv = '';

                    invnameArray.forEach(function(date) {
                        htmlinv += "<span>" + date + "</span><br>";
                    });

                    // Update UI elements
                    $('.invtitalrepdate' + orderId).html(htmlinv);
                    document.getElementById("invlinkattrepdate" + orderId)
                        .setAttribute("onclick", `invSalesRep('${orderId}', '${invDates}', '${totalarray}')`);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

    }

    function invAdminRep(orderId, inv_sales_date, totalarray) {
        // Split the comma-separated dates into an array
        const dates = inv_sales_date.split(',');

        // Generate HTML for each input field based on totalarray length
        let dateInputsHTML = '';
        for (let i = 0; i < totalarray; i++) {
            const dateValue = i < dates.length ? dates[i] : '';
            dateInputsHTML += `
                <input type="date" name="inv_Admin_date" class="form-control" value="${dateValue}">
            `;
        }

        var modalHtml = `
            <div class="modal fade invlink-modal" id="invAdmindate" tabindex="-1" role="dialog">
                <div class="modal-dialog" style="max-width:40% !important">
                    <div class="modal-content">
                        <div class="flex-header modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Add Admin Invoice Date</h4>
                        </div>
                        <div class="modal-body">
                            <form class="UpdatListSalesdate" action="UpdatList" method="POST">                            
                                <div class="form-group">
                                    <input type="hidden" name="orderid" class="form-control" value="${orderId}">
                                    <label for="exampleInputEmail1">Invoice date</label>
                                    ${dateInputsHTML} <!-- Dynamically generated inputs -->
                                </div>  
                            
                                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    
                        
                    </div>
                </div>
            </div>
        `;

        // Append the modal HTML to the body
        $('#invpopAdminDate').html(modalHtml);

        // Show the modal using jQuery
        $('#invAdmindate').modal('show');

        $('.UpdatListSalesdate').submit(function(event) {
            event.preventDefault();

            // Collect all input values into an array
            const invDates = $(this).find('input[name="inv_Admin_date"]')
                .map(function() {
                    return $(this).val().trim(); // Trim whitespace
                })
                .get() // Convert to array
                .join(','); // Join into comma-separated string

            const orderId = $(this).find('input[name="orderid"]').val();

            // Prepare data for submission
            const formData = {
                orderid: orderId,
                inv_Admin_date: invDates // Send as comma-separated string
            };

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    console.log(response);
                    $('#invAdmindate').modal('hide');

                    // Split the dates for UI display
                    const invnameArray = invDates.split(',');
                    let htmlinv = '';

                    invnameArray.forEach(function(date) {
                        htmlinv += "<span>" + date + "</span><br>";
                    });

                    // Update UI elements
                    $('.invtitaladmindate' + orderId).html(htmlinv);
                    document.getElementById("invlinkattadmindate" + orderId)
                        .setAttribute("onclick", `invAdminRep('${orderId}', '${invDates}', '${totalarray}')`);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

    }

    function openQuotationData(type, conv_id, file_name, notes) {
        var html = '';
        html += '<div class="form-group">' +
            '<label for="exampleInputEmail111">Notes For Admin <span style="color:red;">* Do not use apostrophes</span></label>' +
            '<textarea class="form-control" name="notes_admin" id="exampleInputEmail111">' + atob(notes) + '</textarea>' +
            '</div>';
        if (type == 1) {
            $('#freebModal1').html('Remake Quote/Invoice');
            $('#exampleInputEmail1').attr('required', false);
            $('#conv_type').val(1);
            $('#note_div').empty();
            $('#note_div').append(html);
        } else if (type == 2) {
            $('#freebModal1').html('Sample Quote/Invoice');
            $('#exampleInputEmail1').attr('required', false);
            $('#conv_type').val(2);
            $('#note_div').empty();
            $('#note_div').append(html);
        } else if (type == 3) {
            $('#freebModal1').html('Complimentary Quote/Invoice');
            $('#exampleInputEmail1').attr('required', false);
            $('#conv_type').val(3);
            $('#note_div').empty();
            $('#note_div').append(html);
        } else {
            $('#freebModal1').html('Online Store Report');
            $('#exampleInputEmail1').attr('required', true);
            $('#conv_type').val(4);
            $('#note_div').empty();
        }
        $('#main_conv_id').val(conv_id);
        if (file_name.length > 0) {
            var fileExt = file_name.split('.').pop();
            if (fileExt == 'pdf') {
                var url = "../upload/samples/" + file_name;
                console.log(url);
                $('#pdf_source').attr('src', url);
                $('#live_view').hide();
                $('#pdf_source').show();
            } else {
                var baseURL = '<?php echo Yii::app()->request->getBaseUrl(true); ?>';
                var url = "https://view.officeapps.live.com/op/embed.aspx?src=" + baseURL + "/upload/samples/" + file_name;
                $('#live_view').attr('src', url);
                $('#pdf_source').hide();
                $('#live_view').show();
            }
        } else {
            $('#pdf_source').hide();
            $('#live_view').hide();
        }
    }

    function openCommissionData(jogcode, sales1, sales2, years, per, per2, invno, invlnk, month, ordname, commTotal) {
        var html = '';

        //$('#salesrapuserbtn').html('Online Store Report');

        $.ajax({
            type: 'POST',
            url: 'fetchsalesData',
            data: {
                jogCode: jogcode,
                salesRep1: sales1,
                sales2: sales2,
                year: years,
                per: per,
                per2: per2,
                invno: invno,
                invlnk: invlnk,
                month: month,
                ordname: ordname,
                comm_total: commTotal || 0,

            },
            success: function(response) {

                $('#salesrapuserbtn').html(response);
            },
            error: function() {
                // Handle errors
            }
        });
    }

    $(document).on('submit', '#upload_sample', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        var orderId = $(this).find('input[name="main_conv_id"]').val();
        var fileInput = form.find('input[name="files_name"]');
        var pdfdata = fileInput.val(); // This gets the filename        
        // Extracting just the filename without the path
        var filename = fileInput[0].files[0].name;
        $('#updataloading').show();
        $.ajax({
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            url: "<?php echo Yii::app()->request->baseUrl; ?>/order/uploadFreebies",
            success: function(response) {
                var response = JSON.parse(response);

                if (response.status == 1) {
                    $('#updataloading').hide();
                    $('#freebModal').modal('hide');
                    $('.uploaddoc' + orderId + '').removeClass('btn onclickUpload');
                    $('.uploaddoc' + orderId + '').addClass('btn btn-primary onclickView');
                    $('.uploaddoc' + orderId + '').empty().text('View');
                    document.getElementById("btnupdoc" + orderId + "").setAttribute("onclick", "openQuotationData('4', '" + orderId + "', '" + filename + "','')");
                } else {
                    alert('Something Went Wrong');
                }
            }
        })


    })

    $(document).ready(function() {
        $('#goButton').on('click', function() {
            var selectedMonth = $('#months').val();
            var selectedYears = $('#years').val();
            var code_typetoc = "<?php echo $code_typetoc; ?>";

            var exChecked = $('#exid').is(':checked') ? "- EX" : "";
            var thChecked = $('#thid').is(':checked') ? "- TH" : "";

            var check_code = exChecked;
            if (thChecked) {
                check_code += thChecked;
            }

            // If check_code has a value, do not show code_typetoc
            var display_code_typetoc = check_code ? "" : code_typetoc;

            $('.dynamic-selected-month').text('' + selectedMonth + ' ' + selectedYears + ' ' + display_code_typetoc + ' ' + check_code + ' ');
            $('.excelex').val(selectedMonth);
        });

        // Trigger the click event of the "GO" button when the page loads
        $('#goButton').trigger('click');
    });
</script>

<script>
    function printTable() {
        // /var month =  document.getElementByClass("excelex").value;

        // let month = $('.excelex').val();;        
        // // Make an AJAX request to fetch table data from the backend
        // var printWindow = win        
        // printWindow.document.write('<html><head><title>Print</title></head><body>');
        // printWindow.document.write('<h3>Table</h3>');
        // printWindow.document.write(responseData);
        // printWindow.document.write('</body></html>');

        // // Close the document stream to enable printing
        // printWindow.document.close();

        // // Print the content
        // printWindow.print();

        let month = $('.excelex').val();

        // Make an AJAX request to fetch table data from the backend
        $.ajax({
            type: 'POST',
            url: 'ExportPDF', // Update with your server endpoint
            data: {
                month: month
            },
            success: function(responseData) {
                // Open a new window
                var printWindow = window.open('', '', 'height=700,width=700');

                // Write HTML content to the new window
                printWindow.document.write('<html><head><title>Print</title></head><body>');
                printWindow.document.write('<h3>Table</h3>');
                printWindow.document.write(responseData);
                printWindow.document.write('</body></html>');

                // Close the document stream to enable printing
                printWindow.document.close();

                // Print the content
                printWindow.print();
            }
        })
    }

    function copyTable() {
        // Get the month value
        let month = $('.excelex').val();

        // Make an AJAX request to fetch table data from the backend
        $.ajax({
            type: 'POST',
            url: 'ExportCopy', // Update with your server endpoint
            data: {
                month: month
            },
            success: function(tableHTML) {
                // Create a temporary textarea to hold the table HTML
                var tempTextarea = document.createElement("textarea");
                tempTextarea.value = tableHTML;

                // Append the textarea to the document body
                document.body.appendChild(tempTextarea);

                // Select the textarea content
                tempTextarea.select();

                // Copy the selected content to the clipboard
                document.execCommand("copy");

                // Remove the textarea from the document body
                document.body.removeChild(tempTextarea);

                // Alert the user
                alert("Table data copied to clipboard!");
            }
        });
    }

    $(document).on('click', '.admin_comment_edit', function() {
        var conv_id = $(this).attr('conv_id');
        $.ajax({
            type: 'POST',
            data: {
                conv_id: conv_id
            },
            url: '<?php echo Yii::app()->request->baseUrl; ?>/Order/FetchComments',
            success: function(response) {
                $('#d_admin_comments').empty();
                var response = JSON.parse(response);
                if (response.status == 1) {
                    if (response.is_avail == 0) {
                        $('#conv_id_note_admin').val(conv_id);
                        $('#jog_code_note_admin').val(response.jog_code);
                        $('#note_admin_edit').val("");
                        $('#is_avail').val(response.is_avail);
                        $('#adminCommentModal').modal('show');
                    } else {
                        $('#conv_id_note_admin').val(conv_id);
                        //$('#note_admin').val(response.msg);
                        $('#jog_code_note_admin').val(response.jog_code);
                        $('#adminCommentModal').modal('show');
                        $('#is_avail').val(response.is_avail);
                        var data = "";
                        console.log('sassadmasg=>>',response.msg.length);
                        if (response.msg.length != 0) {
                            data = '<div id="removeRemark'+conv_id+'"><center><pre class="alert" style="width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;display: flex;justify-content: space-between;align-items: center;gap: 10px;">"' + response.msg + '" '+ response.order_id +'</pre></center> </div>';
                        }
                        $('#d_admin_comments').append(data);
                        $.ajax({
                            type: 'POST',
                            data: {
                                conv_id: conv_id
                            },
                            url: '<?php echo Yii::app()->request->baseUrl; ?>/order/FetchChats',
                            success: function(response) {
                                var response = JSON.parse(response);
                                if (response.status == 1) {
                                    var html = '';
                                    html = atob(response.msg);
                                    $('#d_admin_comments').append(html);
                                }
                            }
                        })
                        $('#note_admin_edit').val("");
                    }
                }
            }
        })
    })

    $(document).on('submit', '#submit_note_admin', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        var conv_id = $(this).find('input[name="conv_id"]').val();
        $.ajax({
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            url: "<?php echo Yii::app()->request->baseUrl; ?>/order/submitNoteAdmin",
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 1) {
                    var html = '';
                    var text = atob(response.comment);
                    html += '<div id="removeCom'+response.order_id+'"><center><pre class="alert" style="text-align:right; width:100%; height:100%; max-width:900px; overflow-x:auto; color:#FFF; background-color:#990;display: flex;justify-content: space-between;align-items: center;gap: 10px;"><span class=" class="btn btn-secondary" onclick="OrderCommentsDlt('+response.order_id+')"><i class="fa fa-trash-o" aria-hidden="true"></i> </span>' + text + '</pre></center></div>';
                    $('#d_admin_comments').append(html);
                    $('#note_admin_edit').val("");
                    $('.noteaddbtn' + conv_id + '').empty().text('Update Notes');
                    $('.noteaddbtn' + conv_id).css('background-color', '#5bc0de');
                    $('.noteaddbtn' + conv_id).css('color', '#ffff');
                    $('.noteaddbtn' + conv_id).css('border', 'none');
                } else {
                    alert('Something Went Wrong');
                }
            }
        })
    })

    $(document).ready(function() {
        // When the "Excel" button is clicked
        $('#expexcel button').click(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Clear any previous hidden inputs
            $('#expexcel').find('input[type="hidden"]').remove();

            // Get the form data from the second form
            var formData = $('#orderForm').serializeArray();

            // Loop through the form data and append it to the first form as hidden inputs
            $.each(formData, function(i, field) {
                $('<input>').attr({
                    type: 'hidden',
                    name: field.name,
                    value: field.value
                }).appendTo('#expexcel');
            });

            // Submit the first form with the new hidden inputs
            $('#expexcel').submit();
        });

        // Show/hide the "To" month dropdown based on the "tocheck" checkbox
        $('#tocheck').change(function() {
            if ($(this).is(':checked')) {
                $('#months_to').show();
            } else {
                $('#months_to').hide();
            }
        });
    });

    function OrderRemarkDlt(id){        
        if (confirm('Are you sure you want to Delete ?')) {
            $.ajax({
                type: 'POST',
                data: {
                    conv_id: id
                },
                url: '<?php echo Yii::app()->request->baseUrl; ?>/Order/DeleteAdminComments',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {                    
                        $('#removeRemark'+response.ord_id +'').hide();
                    }                
                }
            })
        }
    }

    /**
     * Update commission button label with sales rep name from the JOG Code modal.
     */
    function recalcCommTotal() {
        var salesName = $('#quote_sales_name').val() || 'Comm';
        var labelText = salesName + "'s Comm";
        $('#btn_comm_rep_label').text(labelText);
        $('#btn_comm_rep_label_2').text(labelText);
    }

    /**
     * Open the existing Sales Commission Calculator via the standard flow.
     * When there are two sales reps, opens the #Commission modal.
     * When there is one sales rep, opens the calculator page directly in a new tab.
     */
    function openCommFromQuote() {
        var jogCode  = $('#quote_jog_code').val() || '';
        var sales1   = $('#quote_sales_name').val() || '';
        var sales2   = $('#quote_sales2').val() || '';
        var year     = $('#quote_year').val() || '';
        var month    = $('#quote_month').val() || '';
        var invno    = $('#quote_invno').val() || '';
        var invlnk   = $('#quote_invlnk').val() || '';
        var ordname  = $('#quote_ordname').val() || '';

        if (!jogCode || !sales1) {
            alert('Commission data not available for this estimate.');
            return false;
        }

        // Sum amounts from checked items; commission % = max non-zero % among non-shipping items
        var commTotal = 0, maxPer = 0;
        $('.comm_item_checkbox:checked').each(function() {
            var amt = parseFloat($(this).data('amount')) || 0;
            commTotal += amt;
            if ($(this).data('shipping') != '1') {
                var qdoci = $(this).data('qdoci');
                var liveInput = $('#comm_percent_app' + qdoci);
                var itemPer = liveInput.length ? (parseFloat(liveInput.val()) || 0) : (parseFloat($(this).data('commpercent')) || 0);
                if (itemPer > maxPer) { maxPer = itemPer; }
            }
        });
        var per  = String(Math.round(maxPer));
        var per2 = per;
        commTotal = commTotal.toFixed(2);

        var excludedReps = ['JOG SPORTS', 'Jog Sports', 'FREE', 'REMAKE', 'SAMPLE', 'CANCEL', ''];
        if (sales2 !== '' && excludedReps.indexOf(sales2) === -1) {
            // Two reps: populate then show the existing #Commission modal
            openCommissionData(jogCode, sales1, sales2, year, per, per2, invno, invlnk, month, ordname, commTotal);
            $('#Commission').modal('show');
        } else {
            // One rep: open the Sales Commission page directly in a new tab
            var baseURL = '<?php echo Yii::app()->request->baseUrl; ?>';
            var url = baseURL + '/calculator/SalesCommission/year/' + encodeURIComponent(year) +
                      '/sales/' + encodeURIComponent(sales1) +
                      '?invno=' + encodeURIComponent(invno) +
                      '&per=' + encodeURIComponent(per) +
                      '&jogcode=' + encodeURIComponent(jogCode) +
                      '&invlnk=' + encodeURIComponent(invlnk) +
                      '&ordnm=' + encodeURIComponent(ordname) +
                      '&month=' + encodeURIComponent(month) +
                      '&comm_total=' + encodeURIComponent(commTotal) +
                      '&from_jog=1';
            window.open(url, '_blank');
        }
    }

    function OrderCommentsDlt(id){    
        if (confirm('Are you sure you want to Delete ?')) {    
            $.ajax({
                type: 'POST',
                data: {
                    conv_id: id
                },
                url: '<?php echo Yii::app()->request->baseUrl; ?>/Order/DeleteOrderComments',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 1) {                    
                        $('#removeCom'+response.ord_id +'').hide();
                    }                
                }
            })
        }
    }
</script>