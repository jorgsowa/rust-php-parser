===source===
<?php
new class extends self {};
===errors===
Cannot use "self" as class name, as it is reserved
===php_error <=7.4===
PHP Fatal error:  Cannot use 'self' as class name as it is reserved in Standard input code on line 2
===php_error 8.0-8.3===
PHP Fatal error:  Cannot use 'self' as class name, as it is reserved in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Cannot use "self" as class name, as it is reserved in Standard input code on line 2
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
                        "self"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 24,
                        "end": 28
                      }
                    },
                    "implements": [],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 31
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
