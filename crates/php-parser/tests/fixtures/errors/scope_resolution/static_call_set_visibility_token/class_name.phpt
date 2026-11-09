===source===
<?php
C::public(set);
===errors >=8.4===
unexpected token "public(set)"
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token "public(set)" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "C"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 7
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 7
                }
              },
              "method": {
                "kind": {
                  "Identifier": "public"
                },
                "span": {
                  "start": 9,
                  "end": 15
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "set"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 16,
                            "end": 19
                          }
                        }
                      },
                      "span": {
                        "start": 16,
                        "end": 19
                      }
                    }
                  },
                  "span": {
                    "start": 16,
                    "end": 19
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
