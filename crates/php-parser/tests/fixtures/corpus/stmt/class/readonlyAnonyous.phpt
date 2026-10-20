===source===
<?php

new readonly class {};
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 3
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected token "readonly" in Standard input code on line 3
===ast >=8.3===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "AnonymousClass": {
                    "name": null,
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
                  "start": 7,
                  "end": 28
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 7,
            "end": 28
          }
        }
      },
      "span": {
        "start": 7,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
