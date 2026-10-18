===source===
<?php
class A {
    use T {
        f as final g;
        T::h as final;
    }
}
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
                          "trait_name": null,
                          "method": {
                            "parts": [
                              "f"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 36,
                              "end": 37
                            }
                          },
                          "new_modifier": null,
                          "is_final": true,
                          "new_name": {
                            "parts": [
                              "g"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 47,
                              "end": 48
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 36,
                        "end": 49
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "T"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 58,
                              "end": 59
                            }
                          },
                          "method": {
                            "parts": [
                              "h"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 61,
                              "end": 62
                            }
                          },
                          "new_modifier": null,
                          "is_final": true,
                          "new_name": null
                        }
                      },
                      "span": {
                        "start": 58,
                        "end": 72
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 78
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 80
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 80
  }
}
