===source===
<?php readonly readonly class C {}
===errors <=8.1===
Multiple readonly modifiers are not allowed
'readonly class' requires PHP 8.2 or higher
===errors >=8.2===
Multiple readonly modifiers are not allowed
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'readonly' (T_STRING) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "readonly" in Standard input code on line 1
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting end of file in Standard input code on line 1
===php_error >=8.2===
PHP Fatal error:  Multiple readonly modifiers are not allowed in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 30,
              "end": 31
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 24,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
