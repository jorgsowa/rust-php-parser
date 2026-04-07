===source===
<?php eval('echo 1;');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Eval": {
              "kind": {
                "String": "echo 1;"
              },
              "span": {
                "start": 11,
                "end": 20
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
