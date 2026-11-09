===source===
<?php
const C = f(?, ...[1]);
===errors <=8.5===
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
===errors >=8.6===
Cannot combine partial application and unpacking
Argument unpacking in constant expressions is not supported
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?' in Standard input code on line 2
===php_error 8.0-8.5===
PHP Parse error:  syntax error, unexpected token "?" in Standard input code on line 2
===php_error >=8.6===
PHP Fatal error:  Argument unpacking in constant expressions is not supported in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
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
                        "Spread": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 25,
                                      "end": 26
                                    }
                                  }
                                },
                                "span": {
                                  "start": 25,
                                  "end": 26
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 24,
                            "end": 27
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 27
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 28
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 28
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
