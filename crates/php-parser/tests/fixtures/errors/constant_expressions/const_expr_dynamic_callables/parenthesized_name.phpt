===source===
<?php
const B = (strlen)(...);
===errors <=8.0===
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
              "name": "B",
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
                        "Parenthesized": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "strlen"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 17,
                                "end": 23
                              }
                            }
                          },
                          "span": {
                            "start": 17,
                            "end": 23
                          }
                        }
                      },
                      "span": {
                        "start": 16,
                        "end": 24
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 29
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 29
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
