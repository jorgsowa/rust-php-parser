===source===
<?php
clone(clone($a, []), [])->b;
===errors===
Cannot dereference this expression
===php_error <=8.4===
PHP Parse error:  syntax error, unexpected token "," in Standard input code on line 2
===php_error >=8.5===
PHP Parse error:  syntax error, unexpected token "->" in Standard input code on line 2
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
                  "CloneWith": [
                    {
                      "kind": {
                        "CloneWith": [
                          {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 18,
                              "end": 20
                            }
                          },
                          {
                            "kind": {
                              "Array": []
                            },
                            "span": {
                              "start": 22,
                              "end": 24
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 12,
                        "end": 25
                      }
                    },
                    {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 27,
                        "end": 29
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 30
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 32,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 33
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
