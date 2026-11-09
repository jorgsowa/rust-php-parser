===source===
<?php
foreach ($x as OBJ->a) {}
===errors <=7.4===
'object access on a constant' requires PHP 8.0 or higher
Cannot use temporary expression in write context
===errors 8.0-8.5===
Cannot use temporary expression in write context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR), expecting '[' in Standard input code on line 2
===php_error 8.0-8.5===
PHP Fatal error:  Cannot use temporary expression in write context in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 15,
              "end": 17
            }
          },
          "key": null,
          "value": {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "OBJ"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 21,
                        "end": 24
                      }
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 24
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "a"
                  },
                  "span": {
                    "start": 26,
                    "end": 27
                  }
                }
              }
            },
            "span": {
              "start": 21,
              "end": 27
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 29,
              "end": 31
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
