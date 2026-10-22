===source===
<?php readonly final class Foo {}
===errors <=8.1===
'readonly class' requires PHP 8.2 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'final' (T_FINAL) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "final" in Standard input code on line 1
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting end of file in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 27,
              "end": 30
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": true,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 21,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
