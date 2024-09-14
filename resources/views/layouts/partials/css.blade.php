<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<link rel="stylesheet" href="{{ asset('custom.css') }}">


<style>
    .search-people {
        width: 300px;
        background: #f2f3f6;
        padding: 1em;
        border: 1px solid darkgrey;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 5px 10px rgba(0, 0, 0, 0.05);
        border-radius: 3px;
        overflow: hidden;
    }

    .search-input-query {
        width: 100%;
        padding: 0.5em;
        border: 1px solid darkgrey;
        border-radius: 3px;
        font-size: 1em;

        &:focus~.counter {
            opacity: 0.1;
            transition: opacity 1s ease-in;
        }
    }

    .search-list-wrap {
        margin-top: 0.4em;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .search-list {
        max-height: 220px;
    }

    .search-list-item {
        font-size: 0.9em;
        padding: 0.5em 0.8em;
        border-bottom: 1px solid darkgrey;
        border-top: 1px solid white;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        word-wrap: normal;
        max-width: 100%;

        &:first-child {
            border-top: none;
        }

        &:last-child {
            border-bottom: none;
        }
    }

    .search-list-item-link {
        color: #444;
        text-decoration: none;
    }

    .search-item-list-subtext {
        font-size: 85%;
        color: grey;

        &:before {
            content: ' ('
        }

        &:after {
            content: ')'
        }
    }

    .search-list-item--disable {
        text-align: center;
        border-bottom: none;
        animation: shake 0.6s;
        color: #9da1b1;
    }

    .search-counter {
        position: absolute;
        bottom: -15px;
        right: 10px;
        z-index: 0;
        font-size: 3.5em;
        color: black;
        transform: translateY(0);
        opacity: 0;
    }
</style>
