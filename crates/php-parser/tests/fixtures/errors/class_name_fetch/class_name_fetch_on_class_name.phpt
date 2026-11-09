===source===
<?php echo A::class::class;
===errors <=7.4===
'class constant dereferencing' requires PHP 8.0 or higher
Cannot use ::class with dynamic class name
===errors >=8.0===
Cannot use "::class" on string
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '::' (T_PAAMAYIM_NEKUDOTAYIM), expecting ';' or ',' in Standard input code on line 1
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type string in Standard input code on line 1
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on string in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "ClassConstAccess": {
                      "class": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 11,
                              "end": 12
                            }
                          }
                        },
                        "span": {
                          "start": 11,
                          "end": 12
                        }
                      },
                      "member": {
                        "kind": {
                          "Identifier": "class"
                        },
                        "span": {
                          "start": 14,
                          "end": 19
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 19
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 21,
                    "end": 26
                  }
                }
              }
            },
            "span": {
              "start": 11,
              "end": 26
            }
          }
        ]
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
