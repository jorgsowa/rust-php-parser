===source===
<?php

final readonly class A {
}
===errors <=8.1===
'readonly class' requires PHP 8.2 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'readonly' (T_STRING), expecting abstract (T_ABSTRACT) or final (T_FINAL) or class (T_CLASS) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "readonly", expecting "abstract" or "final" or "class" in Standard input code on line 3
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting "abstract" or "final" or "class" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 28,
              "end": 29
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
        "start": 22,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
