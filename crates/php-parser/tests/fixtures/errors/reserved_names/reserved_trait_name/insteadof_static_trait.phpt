===source===
<?php
class A {
    use T {
        static::f insteadof B;
    }
}
===errors===
Cannot use "static" as trait name, as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '::' (T_PAAMAYIM_NEKUDOTAYIM), expecting as (T_AS) in Standard input code on line 4
===php_error 8.0-8.3===
PHP Fatal error:  Cannot use 'static' as trait name, as it is reserved in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot use "static" as trait name, as it is reserved in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
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
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "T"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 24,
                        "end": 25
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "static"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 36,
                              "end": 42
                            }
                          },
                          "method": {
                            "parts": [
                              "f"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 44,
                              "end": 45
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "B"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 56,
                                "end": 57
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 36,
                        "end": 58
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 64
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}
