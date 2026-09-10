<?php

/*
    Questo file contiene le traduzioni in italiano dei messaggi di errore di validazione.
    ":attribute" è un segnaposto che viene sostituito con il nome del campo che ha generato l'errore.
*/
return [
    // Elenco dei tipi di campi che possono generare errori di validazione.
    'required' => 'Il campo :attribute è obbligatorio.',
    'string' => 'Il campo :attribute deve essere una stringa.',
    'email' => 'Il campo :attribute deve essere un indirizzo email valido.',
    'max' => [
        'string' => 'Il campo :attribute non può contenere più di :max caratteri.',
    ],
    'min' => [
        'string' => 'Il campo :attribute deve contenere almeno :min caratteri.',
    ],
    'unique' => 'Il valore del campo :attribute è già stato utilizzato.',
    'confirmed' => 'I campi password non corrispondono.',
    'date' => 'Il campo :attribute non contiene una data valida.',
    'after_or_equal' => 'Il campo :attribute deve essere una data successiva o uguale a quella odierna.',
    'in' => 'Il valore selezionato per :attribute non è valido.',

    // Elenco dei nomi specificati nei campi dei form e riutilizzati mediante il metodo rules() dei Form Request.
    'attributes' => [
        'name' => 'nome', // Per ogni chiave nell'array, il valore corrispondente è la stringa visualizzata al posto di ":attribute".
        'email' => 'email',
        'password' => 'password',
        'password_confirmation' => 'conferma password',
        'title' => 'titolo',
        'description' => 'descrizione',
        'due_date' => 'data di scadenza',
        'priority' => 'priorità',
        'status' => 'stato',
    ],
];
