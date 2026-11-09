===source===
<?php
class K {
    const F = static::m(?);
}
===errors <=8.5===
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
===errors >=8.6===
"static" is not allowed in compile-time constants
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?' in Standard input code on line 3
===php_error 8.0-8.5===
PHP Parse error:  syntax error, unexpected token "?" in Standard input code on line 3
===php_error >=8.6===
PHP Fatal error:  "static" is not allowed in compile-time constants in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "K",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "F",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "value": {
                    "kind": {
                      "StaticMethodCall": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "static"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 30,
                                "end": 36
                              }
                            }
                          },
                          "span": {
                            "start": 30,
                            "end": 36
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "m"
                          },
                          "span": {
                            "start": 38,
                            "end": 39
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": "Placeholder",
                            "span": {
                              "start": 40,
                              "end": 41
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 42
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 43
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
