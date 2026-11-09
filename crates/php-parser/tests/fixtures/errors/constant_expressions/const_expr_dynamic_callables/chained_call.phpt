===source===
<?php
const C = f(...)(...);
===errors <=8.0===
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
===errors 8.1-8.4===
'first-class callables in constant expressions' requires PHP 8.5 or higher
===errors >=8.5===
Cannot use dynamic function name in constant expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 2
===php_error 8.1-8.4===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot use dynamic function name in constant expression in Standard input code on line 2
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
                "CallableCreate": {
                  "kind": {
                    "Function": {
                      "kind": {
                        "CallableCreate": {
                          "kind": {
                            "Function": {
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
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 16,
                        "end": 22
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 27
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 27
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
