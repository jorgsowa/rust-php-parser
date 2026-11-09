===source===
<?php
new class extends \static {};
===errors <=7.4===
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'\static' is an invalid class name
===errors >=8.0===
'\static' is an invalid class name
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC), expecting identifier (T_STRING) in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  '\static' is an invalid class name in Standard input code on line 2
===ast===
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
                      "is_readonly": false
                    },
                    "extends": {
                      "parts": [
                        "static"
                      ],
                      "kind": "FullyQualified",
                      "span": {
                        "start": 24,
                        "end": 31
                      }
                    },
                    "implements": [],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 34
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 34
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
