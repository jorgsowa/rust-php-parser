===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php enum E: string { case A = static::class; }
===errors <=8.0===
'enums' requires PHP 8.1 or higher
static::class cannot be used for compile-time class name resolution
===errors >=8.1===
static::class cannot be used for compile-time class name resolution
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 1
===php_error 8.1===
PHP Fatal error:  Enum case value must be compile-time evaluatable in Standard input code on line 1
===php_error >=8.2===
PHP Fatal error:  static::class cannot be used for compile-time class name resolution in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": {
            "parts": [
              "string"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 14,
              "end": 20
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 28,
                      "end": 29
                    }
                  },
                  "value": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "static"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 32,
                                "end": 38
                              }
                            }
                          },
                          "span": {
                            "start": 32,
                            "end": 38
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "class"
                          },
                          "span": {
                            "start": 40,
                            "end": 45
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 32,
                      "end": 45
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 46
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
