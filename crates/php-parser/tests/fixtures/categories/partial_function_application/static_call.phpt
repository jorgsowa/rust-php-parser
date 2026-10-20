===source===
<?php $fn = Foo::bar(?);
===php_error <=8.5===
PHP Parse error:  syntax error, unexpected token "?" in Standard input code on line 1
===ast >=8.6===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "fn"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "StaticMethodCall": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 12,
                            "end": 15
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 15
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "bar"
                      },
                      "span": {
                        "start": 17,
                        "end": 20
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": "Placeholder",
                        "span": {
                          "start": 21,
                          "end": 22
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 12,
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
