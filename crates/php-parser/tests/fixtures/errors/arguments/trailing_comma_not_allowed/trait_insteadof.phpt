===source===
<?php
class C {
    use T { T::x insteadof U,; }
}
===errors===
expected trait name, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting identifier (T_STRING) or namespace (T_NAMESPACE) or \\ (T_NS_SEPARATOR) in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                              "T"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 28,
                              "end": 29
                            }
                          },
                          "method": {
                            "parts": [
                              "x"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 31,
                              "end": 32
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "U"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 43,
                                "end": 44
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 46
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 48
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
