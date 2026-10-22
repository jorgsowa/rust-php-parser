===source===
<?php match ($a) { default => [] }[0];
===errors <=7.4===
'match expressions' requires PHP 8.0 or higher
Cannot dereference this expression
===errors >=8.0===
Cannot dereference this expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'default' (T_DEFAULT) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "[" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "Match": {
                    "subject": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 13,
                        "end": 15
                      }
                    },
                    "arms": [
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 30,
                            "end": 32
                          }
                        },
                        "span": {
                          "start": 19,
                          "end": 32
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 6,
                  "end": 34
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 35,
                  "end": 36
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 37
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
