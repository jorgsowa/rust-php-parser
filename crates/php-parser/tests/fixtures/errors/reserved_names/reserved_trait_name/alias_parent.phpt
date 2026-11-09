===source===
<?php
class A {
    use T {
        parent::h as i;
    }
}
===errors >=8.0===
Cannot use "parent" as trait name, as it is reserved
===php_error 8.0-8.3===
PHP Fatal error:  Cannot use 'parent' as trait name, as it is reserved in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot use "parent" as trait name, as it is reserved in Standard input code on line 3
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
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "parent"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 36,
                              "end": 42
                            }
                          },
                          "method": {
                            "parts": [
                              "h"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 44,
                              "end": 45
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "i"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 49,
                              "end": 50
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 36,
                        "end": 51
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 57
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 59
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 59
  }
}
