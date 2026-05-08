===source===
<?php 'a\bc';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "a\\bc"
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 13
  }
}
