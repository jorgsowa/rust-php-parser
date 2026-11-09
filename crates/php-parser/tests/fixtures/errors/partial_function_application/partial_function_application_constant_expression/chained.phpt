===source===
<?php
const E = f(?)(?);
===errors <=8.5===
'partial function application' requires PHP 8.6 or higher
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
===errors >=8.6===
Cannot use dynamic function name in constant expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?' in Standard input code on line 2
===php_error 8.0-8.5===
PHP Parse error:  syntax error, unexpected token "?" in Standard input code on line 2
===php_error >=8.6===
PHP Fatal error:  Cannot use dynamic function name in constant expression in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "E",
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
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 16,
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
                "start": 16,
                "end": 23
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 23
            }
          }
        ]
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
