===source===
<?php
class C {
    use T {
        x as y?><?= as my_echo;
    }
}
===errors >=8.0===
expected identifier, found '<?php'
expected '::' or 'as', found identifier
expected identifier, found ';'
===php_error >=8.0===
PHP Parse error:  Cannot use "<?=" as an identifier in Standard input code on line 4
===ast <=7.4===
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
                        "Alias": {
                          "trait_name": null,
                          "method": {
                            "parts": [
                              "x"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 36,
                              "end": 37
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "y"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 41,
                              "end": 42
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 36,
                        "end": 44
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": {
                            "parts": [
                              "<?="
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 44,
                              "end": 47
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "my_echo"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 51,
                              "end": 58
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 44,
                        "end": 59
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 65
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
===ast >=8.0===
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
                        "Alias": {
                          "trait_name": null,
                          "method": {
                            "parts": [
                              "x"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 36,
                              "end": 37
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "y"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 41,
                              "end": 42
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 36,
                        "end": 44
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 65
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
