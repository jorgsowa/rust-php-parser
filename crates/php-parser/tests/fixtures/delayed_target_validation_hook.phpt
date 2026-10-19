===source===
<?php
class C {
    public string $h {
        #[DelayedTargetValidation] #[NoDiscard] get => $this->h;
        #[DelayedTargetValidation] #[Deprecated] set => $value;
    }
}
===ast >=8.5===
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
                "Property": {
                  "name": {
                    "name": "h",
                    "span": {
                      "start": 34,
                      "end": 36
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 27,
                          "end": 33
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 33
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 94,
                                  "end": 99
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "h"
                                },
                                "span": {
                                  "start": 101,
                                  "end": 102
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 94,
                            "end": 102
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "DelayedTargetValidation"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 49,
                              "end": 72
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 49,
                            "end": 72
                          }
                        },
                        {
                          "name": {
                            "parts": [
                              "NoDiscard"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 76,
                              "end": 85
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 76,
                            "end": 85
                          }
                        }
                      ],
                      "span": {
                        "start": 47,
                        "end": 103
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Variable": "value"
                          },
                          "span": {
                            "start": 160,
                            "end": 166
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "DelayedTargetValidation"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 114,
                              "end": 137
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 114,
                            "end": 137
                          }
                        },
                        {
                          "name": {
                            "parts": [
                              "Deprecated"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 141,
                              "end": 151
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 141,
                            "end": 151
                          }
                        }
                      ],
                      "span": {
                        "start": 112,
                        "end": 167
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 173
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 175
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 175
  }
}
