===source===
<?php
$x = new Foo->bar;
===errors===
Cannot use a new expression with a class name as a dereferenceable expression without parentheses
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "->" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 15,
                                  "end": 18
                                }
                              }
                            },
                            "span": {
                              "start": 15,
                              "end": 18
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 18
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "bar"
                      },
                      "span": {
                        "start": 20,
                        "end": 23
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
