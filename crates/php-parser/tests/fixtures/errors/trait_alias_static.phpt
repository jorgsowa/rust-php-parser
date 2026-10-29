===source===
<?php
class A { use T { T::a as static; } }
===errors <=8.2===
Cannot use 'static' as method modifier
===errors >=8.3===
Cannot use "static" as method modifier in trait alias
===php_error <=8.2===
PHP Fatal error:  Cannot use 'static' as method modifier in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "static" as method modifier in trait alias in Standard input code on line 2
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
                        "start": 20,
                        "end": 21
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "T"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 24,
                              "end": 25
                            }
                          },
                          "method": {
                            "parts": [
                              "a"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 27,
                              "end": 28
                            }
                          },
                          "new_modifier": null,
                          "invalid_modifier": {
                            "name": "static",
                            "span": {
                              "start": 32,
                              "end": 38
                            }
                          },
                          "new_name": null
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 39
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 41
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
