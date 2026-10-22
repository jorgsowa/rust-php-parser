===source===
<?php abstract readonly class Foo {}
===errors <=8.1===
'abstract readonly class' requires PHP 8.2 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'readonly' (T_STRING), expecting abstract (T_ABSTRACT) or final (T_FINAL) or class (T_CLASS) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "readonly", expecting "abstract" or "final" or "class" in Standard input code on line 1
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting "abstract" or "final" or "class" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 30,
              "end": 33
            }
          },
          "modifiers": {
            "is_abstract": true,
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
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
