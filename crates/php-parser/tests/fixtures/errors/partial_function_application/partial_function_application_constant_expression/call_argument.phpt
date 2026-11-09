===source===
<?php
const B = f(?, g());
===errors <=8.5===
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
===errors >=8.6===
Constant expression contains invalid operations
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?' in Standard input code on line 2
===php_error 8.0-8.5===
PHP Parse error:  syntax error, unexpected token "?" in Standard input code on line 2
===php_error >=8.6===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "FunctionCall": {
                  "name": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "f"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 16,
                          "end": 17
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 17
                    }
                  },
                  "args": [
                    {
                      "name": null,
                      "kind": "Placeholder",
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    },
                    {
                      "name": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "g"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 21,
                                      "end": 22
                                    }
                                  }
                                },
                                "span": {
                                  "start": 21,
                                  "end": 22
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 21,
                            "end": 24
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 24
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 25
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 25
            }
          }
        ]
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
