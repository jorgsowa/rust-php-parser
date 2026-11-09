===source===
<?php
const D = (function () {})(?);
===errors <=8.5===
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
              "name": "D",
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
                      "Parenthesized": {
                        "kind": {
                          "Closure": {
                            "is_static": false,
                            "by_ref": false,
                            "params": [],
                            "use_vars": [],
                            "return_type": null,
                            "body": [],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 17,
                          "end": 31
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 32
                    }
                  },
                  "args": [
                    {
                      "name": null,
                      "kind": "Placeholder",
                      "span": {
                        "start": 33,
                        "end": 34
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 35
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 35
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
