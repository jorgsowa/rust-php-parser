===source===
<?php
"{$c::private(set)}";
===errors >=8.4===
unexpected token "private(set)"
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token "private(set)" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "StaticMethodCall": {
                      "class": {
                        "kind": {
                          "Variable": "c"
                        },
                        "span": {
                          "start": 8,
                          "end": 10
                        }
                      },
                      "method": {
                        "kind": {
                          "Identifier": "private"
                        },
                        "span": {
                          "start": 12,
                          "end": 19
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
                                    "start": 20,
                                    "end": 23
                                  }
                                }
                              },
                              "span": {
                                "start": 20,
                                "end": 23
                              }
                            }
                          },
                          "span": {
                            "start": 20,
                            "end": 23
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 8,
                    "end": 24
                  }
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
