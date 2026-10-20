===source===
<?php
clone(...)->b;
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
                  "CallableCreate": {
                    "kind": {
                      "Function": {
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
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 16
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 18,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
