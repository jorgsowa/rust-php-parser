===source===
<?php
clone(...$a)->b;
===errors===
Cannot dereference this expression
===php_error <=8.4===
PHP Parse error:  syntax error, unexpected token "..." in Standard input code on line 2
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
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "clone"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 6,
                            "end": 11
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 11
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Spread": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 15,
                              "end": 17
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 17
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 6,
                  "end": 18
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 20,
                  "end": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
