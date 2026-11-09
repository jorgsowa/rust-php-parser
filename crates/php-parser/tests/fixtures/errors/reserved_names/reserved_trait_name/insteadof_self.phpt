===source===
<?php
class A {
    use T {
        T::g insteadof self;
    }
}
===errors >=8.0===
Cannot use "self" as trait name, as it is reserved
===php_error 8.0-8.3===
PHP Fatal error:  Cannot use 'self' as trait name, as it is reserved in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot use "self" as trait name, as it is reserved in Standard input code on line 3
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
                              "T"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 36,
                              "end": 37
                            }
                          },
                          "method": {
                            "parts": [
                              "g"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 39,
                              "end": 40
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "self"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 51,
                                "end": 55
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 36,
                        "end": 56
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 62
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 64
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 64
  }
}
