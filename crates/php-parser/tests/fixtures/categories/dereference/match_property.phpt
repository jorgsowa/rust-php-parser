===source===
<?php match ($a) { default => $o }->b;
===errors===
Cannot dereference this expression
===php_error===
PHP Parse error:  syntax error, unexpected token "->" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
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
                            "Variable": "o"
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
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 36,
                  "end": 37
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
