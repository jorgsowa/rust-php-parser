===source===
<?php
#[A]
readonly abstract class Foo {}
===errors <=7.4===
'attributes' requires PHP 8.0 or higher
'abstract readonly class' requires PHP 8.2 or higher
===errors 8.0-8.1===
'abstract readonly class' requires PHP 8.2 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'abstract' (T_ABSTRACT) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "readonly" in Standard input code on line 3
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 35,
              "end": 38
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
          "attributes": [
            {
              "name": {
                "parts": [
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 9
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 9
              }
            }
          ]
        }
      },
      "span": {
        "start": 29,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
