===source===
<?php
class K {
    const G = $o->m(?);
}
===errors <=8.5===
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
===errors >=8.6===
Constant expression contains invalid operations
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?' in Standard input code on line 3
===php_error 8.0-8.5===
PHP Parse error:  syntax error, unexpected token "?" in Standard input code on line 3
===php_error >=8.6===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 3
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
                    "name": "G",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "value": {
                    "kind": {
                      "MethodCall": {
                        "object": {
                          "kind": {
                            "Variable": "o"
                          },
                          "span": {
                            "start": 30,
                            "end": 32
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "m"
                          },
                          "span": {
                            "start": 34,
                            "end": 35
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": "Placeholder",
                            "span": {
                              "start": 36,
                              "end": 37
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 38
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 39
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
