===config===
min_php=8.3
===source===
<?php new readonly readonly class {};
===errors===
expected ';' after expression
expected class name, found '{'
===php_error===
PHP Fatal error:  Multiple readonly modifiers are not allowed in Standard input code on line 1
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
                  "Name": {
                    "parts": [
                      "readonly"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 18
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 18
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Class": {
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
        "start": 28,
        "end": 36
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 36,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
