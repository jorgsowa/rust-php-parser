===config===
min_php=8.1
max_php=8.1
===source===
<?php
$x = new Foo()->bar;
===errors===
'dereferencing a new expression without parentheses' requires PHP 8.4 or higher (targeting PHP 8.1)
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
                              "Identifier": "Foo"
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
                        "end": 20
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "bar"
                      },
                      "span": {
                        "start": 22,
                        "end": 25
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "->" in Standard input code on line 2
