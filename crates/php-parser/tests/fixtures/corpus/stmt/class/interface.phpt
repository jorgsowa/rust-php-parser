===source===
<?php

interface A extends C, D {
    public function a();
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "A",
            "span": {
              "start": 17,
              "end": 18
            }
          },
          "extends": [
            {
              "parts": [
                "C"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 27,
                "end": 28
              }
            },
            {
              "parts": [
                "D"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 30,
                "end": 31
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 54,
                      "end": 55
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 38,
                "end": 58
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}
