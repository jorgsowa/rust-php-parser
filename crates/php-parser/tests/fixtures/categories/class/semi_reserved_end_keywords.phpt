===source===
<?php
class C {
    function endif() {}
    function endfor() {}
    function endforeach() {}
    function endwhile() {}
    function endswitch() {}
    function enddeclare() {}
}
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
                "Method": {
                  "name": {
                    "name": "endif",
                    "span": {
                      "start": 29,
                      "end": 34
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 39
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "endfor",
                    "span": {
                      "start": 53,
                      "end": 59
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 44,
                "end": 64
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "endforeach",
                    "span": {
                      "start": 78,
                      "end": 88
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 69,
                "end": 93
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "endwhile",
                    "span": {
                      "start": 107,
                      "end": 115
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 98,
                "end": 120
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "endswitch",
                    "span": {
                      "start": 134,
                      "end": 143
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 125,
                "end": 148
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "enddeclare",
                    "span": {
                      "start": 162,
                      "end": 172
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 153,
                "end": 177
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 179
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 179
  }
}
