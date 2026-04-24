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
          "name": "C",
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
                  "name": "endif",
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
                  "name": "endfor",
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
                  "name": "endforeach",
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
                  "name": "endwhile",
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
                  "name": "endswitch",
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
                  "name": "enddeclare",
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
